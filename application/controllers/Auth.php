<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function simple_verification()
    {
        $this->is_logged_in();

        echo $this->load->view('examples/page_header', '', TRUE);

        echo '<p>';
        if (!empty($this->auth_role)) {
            echo $this->auth_role . ' logged in!<br />
                User ID is ' . $this->auth_user_id . '<br />
                Auth level is ' . $this->auth_level . '<br />
                Username is ' . $this->auth_username;

            if ($http_user_cookie_contents = $this->input->cookie(config_item('http_user_cookie_name'))) {
                $http_user_cookie_contents = unserialize($http_user_cookie_contents);

                echo '<br />
                    <pre>';

                print_r($http_user_cookie_contents);

                echo '</pre>';
            }

            if (config_item('add_acl_query_to_auth_functions') && $this->acl) {
                echo '<br />
                    <pre>';

                print_r($this->acl);

                echo '</pre>';
            }

            /**
             * ACL usage doesn't require ACL be added to auth vars.
             * If query not performed during authentication,
             * the acl_permits function will query the DB.
             */
            if ($this->acl_permits('general.secret_action')) {
                echo '<p>ACL permission grants action!</p>';
            }
        } else {
            echo 'Nobody logged in.';
        }

        echo '</p>';

        echo $this->load->view('examples/page_footer', '', TRUE);
    }

    public function register()
    {
        if (!$this->verify_min_level(1)) {
            $data['title'] = 'Register Page';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $user_data = [
                    'username' => $this->input->post('username'),
                    'passwd' => $this->input->post('password'),
                    'email' => $this->input->post('email'),
                    'auth_level' => '1',
                ];

//            $user_data = [
//                'username' => 'admin',
//                'passwd' => 'JongCelebes80700',
//                'email' => 'archisdiningrat@gmail.com',
//                'auth_level' => '9',
//            ];

                $this->is_logged_in();

                // Load resources
                $this->load->model('user_model');
                $this->load->model('validation_callables');
                $this->load->library('form_validation');
                $this->load->library('email');

                $this->form_validation->set_data($user_data);

                $validation_rules = [
                    [
                        'field' => 'username',
                        'label' => 'username',
                        'rules' => 'max_length[12]|is_unique[' . config_item('user_table') . '.username]',
                        'errors' => [
                            'is_unique' => 'Username already in use.'
                        ]
                    ],
                    [
                        'field' => 'passwd',
                        'label' => 'passwd',
                        'rules' => [
                            'trim',
                            'required',
                            [
                                '_check_password_strength',
                                [$this->validation_callables, '_check_password_strength']
                            ]
                        ],
                        'errors' => [
                            'required' => 'The password field is required.'
                        ]
                    ],
                    [
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]',
                        'errors' => [
                            'is_unique' => 'Email address already in use.'
                        ]
                    ],
                    [
                        'field' => 'auth_level',
                        'label' => 'auth_level',
                        'rules' => 'required|integer|in_list[1,6,9]'
                    ]
                ];

                $this->form_validation->set_rules($validation_rules);


                if ($this->form_validation->run()) {
                    $user_data['passwd'] = $this->authentication->hash_passwd($user_data['passwd']);
                    $user_data['user_id'] = $this->user_model->get_unused_id();
                    $user_data['created_at'] = date('Y-m-d H:i:s');

                    // If username is not used, it must be entered into the record as NULL
                    if (empty($user_data['username'])) {
                        $user_data['username'] = NULL;
                    }

                    $this->db->set($user_data)->insert(config_item('user_table'));

                    if ($this->db->affected_rows() == 1)
                        $data['success'] = 'Congratulations User ' . $user_data['username'] . ' was created.';

                    $subject = 'User successfully Created';
                    $from_email = 'homestead@bilinedev.com';
                    $from_name = 'Homestead Bilinedev';

                    $this->send_email($subject, $data['success'], $from_email, $from_name, $user_data['email']);

//                $this->send_email($subject,'A user just registered, username :'.$user_data['username'],$from_email,$from_name,'ali.fahmi@bilinedev.com');

                    $this->render_view('register', $data);
                } else {
                    $data['errors'] = validation_errors();
                    $this->render_view('register', $data);
                }
            } else {
                $this->render_view('register', $data);
            }

        } else {
            redirect('/');
        }

    }

    public function login()
    {

        if (!$this->verify_min_level(1)) {
            if ($this->uri->uri_string() == 'auth/login')
                show_404();

            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')
                $this->require_min_level(1);

            $this->setup_login_form();

            $data['title'] = 'Login Page';

            $this->render_view('login', $data);
        } else {
            redirect('/');
        }

    }

    public function logout()
    {
        $this->authentication->logout();

        // Set redirect protocol
        $redirect_protocol = USE_SSL ? 'https' : NULL;

        redirect(site_url(LOGIN_PAGE . '?logout=1', $redirect_protocol));
    }

    public function recover()
    {
        $data['title'] = 'Recover Account';
        // Load resources
        $this->load->model('user_model');
        $this->load->library('email');

        /// If IP or posted email is on hold, display message
        if ($on_hold = $this->authentication->current_hold_status(TRUE)) {
            $view_data['disabled'] = 1;
        } else {
            // If the form post looks good
            if ($this->tokens->match && $this->input->post('email')) {
                if ($user_data = $this->user_model->get_recovery_data($this->input->post('email'))) {
                    // Check if user is banned
                    if ($user_data->banned == '1') {
                        // Log an error if banned
                        $this->authentication->log_error($this->input->post('email', TRUE));

                        // Show special message for banned user
                        $view_data['banned'] = 1;
                    } else {
                        /**
                         * Use the authentication libraries salt generator for a random string
                         * that will be hashed and stored as the password recovery key.
                         * Method is called 4 times for a 88 character string, and then
                         * trimmed to 72 characters
                         */
                        $recovery_code = substr($this->authentication->random_salt()
                            . $this->authentication->random_salt()
                            . $this->authentication->random_salt()
                            . $this->authentication->random_salt(), 0, 72);

                        // Update user record with recovery code and time
                        $this->user_model->update_user_raw_data(
                            $user_data->user_id,
                            [
                                'passwd_recovery_code' => $this->authentication->hash_passwd($recovery_code),
                                'passwd_recovery_date' => date('Y-m-d H:i:s')
                            ]
                        );

                        // Set the link protocol
                        $link_protocol = USE_SSL ? 'https' : NULL;

                        // Set URI of link
                        $link_uri = 'auth/recovery_verification/' . $user_data->user_id . '/' . $recovery_code;

                        $view_data['special_link'] = anchor(
                            site_url($link_uri, $link_protocol),
                            site_url($link_uri, $link_protocol),
                            'target ="_blank"'
                        );

                        $view_data['confirmation'] = 1;

                        $subject = 'Account recovery';
                        $from_email = 'homestead@bilinedev.com';
                        $from_name = 'Homestead Bilinedev';
                        $message = 'click link to reset your password : ' . $view_data['special_link'];

                        $this->send_email($subject, $message, $from_email, $from_name, $this->input->post('email'));

                    }
                } // There was no match, log an error, and display a message
                else {
                    // Log the error
                    $this->authentication->log_error($this->input->post('email', TRUE));

                    $view_data['no_match'] = 1;
                }
            }
        }

        $this->render_view('recover', (isset($view_data)) ? $view_data : '', TRUE);
    }

    public function recovery_verification($user_id = '', $recovery_code = '')
    {
        /// If IP is on hold, display message
        if ($on_hold = $this->authentication->current_hold_status(TRUE)) {
            $view_data['disabled'] = 1;
        } else {
            // Load resources
            $this->load->model('user_model');

            if (
                /**
                 * Make sure that $user_id is a number and less
                 * than or equal to 10 characters long
                 */
                is_numeric($user_id) && strlen($user_id) <= 10 &&

                /**
                 * Make sure that $recovery code is exactly 72 characters long
                 */
                strlen($recovery_code) == 72 &&

                /**
                 * Try to get a hashed password recovery
                 * code and user salt for the user.
                 */
                $recovery_data = $this->user_model->get_recovery_verification_data($user_id)
            ) {
                /**
                 * Check that the recovery code from the
                 * email matches the hashed recovery code.
                 */
                if ($recovery_data->passwd_recovery_code == $this->authentication->check_passwd($recovery_data->passwd_recovery_code, $recovery_code)) {
                    $view_data['user_id'] = $user_id;
                    $view_data['username'] = $recovery_data->username;
                    $view_data['recovery_code'] = $recovery_data->passwd_recovery_code;
                } // Link is bad so show message
                else {
                    $view_data['recovery_error'] = 1;

                    // Log an error
                    $this->authentication->log_error('');
                }
            } // Link is bad so show message
            else {
                $view_data['recovery_error'] = 1;

                // Log an error
                $this->authentication->log_error('');
            }

            /**
             * If form submission is attempting to change password
             */
            if ($this->tokens->match) {
                $this->user_model->recovery_password_change();
            }
        }

        $this->render_view('change_password', $view_data);
    }

    private function render_view($page, $data = NULL)
    {
        $this->load->view('templates/header');
        $this->load->view('auth/' . $page, $data);
        $this->load->view('templates/footer');
    }

    private function send_email($subject, $message, $from_email, $from_name, $to)
    {
        $this->email->from($from_email, $from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

}