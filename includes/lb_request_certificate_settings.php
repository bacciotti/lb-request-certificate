<?php
//=================================================
// Settings Page
//=================================================
// Create plugin pages
// Register menu
// Code the main function 'lb_request_certificate_download_action_hook_function'
// For the sake of security, wpnonce os used.
//=================================================
add_action('admin_menu', 'lb_request_certificate_menu');
function lb_request_certificate_menu()
{
    add_menu_page(
        'LB Request Certificate',
        'LB Request Certificate',
        'manage_options',
        'lb-request-certificate',
        'lb_request_certificate_menu_page',
        'dashicons-format-aside',
        99
    );
}

function lb_request_certificate_menu_page()
{
    ?>
    <div>
        <h1>LB Request Certificate</h1>
        <div id="lb-request-certificate-advice">
            This plugin allows you to request and download the customer's certificate (or other media) just inserting
            its name.
        </div>
        <form method="post" action="admin-post.php">
            <h3>Type customer ID:</h3>
            <?php wp_nonce_field('lb_request_certificate_download_action_hook_function', '_wpnonce'); ?>
            <input name="user_id" type="text" placeholder="E.g.: 123456789">
            <input type="hidden" name="action" value="lb_request_certificate_download_action_hook">
            <input type="submit" value="Acessar Certificado" id="request-button">
            <p>Only numbers. The ID should match the PDF file name.</p>
        </form>
    </div>
    <?php
}

add_action('admin_post_lb_request_certificate_download_action_hook', 'lb_request_certificate_download_action_hook_function');
function lb_request_certificate_download_action_hook_function()
{
    if (wp_verify_nonce( $_POST['_wpnonce'], 'lb_request_certificate_download_action_hook_function' )) {
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

        if (is_null($user_id) or strlen(trim($user_id)) == 0) {
            echo "<p id='request-message'>Type a valid ID number.</p>";
        } else {
            $user_id = sanitize_text_field($_POST['user_id']);
            $args = array(
                'posts_per_page' => 1,
                'post_type' => 'attachment',
                'name' => trim($user_id),
            );
            $_header = get_posts($args);
            $header = $_header ? array_pop($_header) : null;
            $result = $header ? wp_get_attachment_url($header->ID) : '';
            $ext = trim(substr($result, -4, 4));

            if ($ext != ".pdf" && $ext != ".png" && $ext != ".jpg" && $ext != ".jpeg") {
                echo "<p >There is no PDF, PNG, JPG or JPEG file with this name.";
            } else {
                ?>
                <a href="<?= $result ?>">
                    <button>Baixar!</button>
                </a>
                <?php
            }
        }
    }
}