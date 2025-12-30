<?php
namespace WPDCSM\Backend\BasicTabs;

class Social {
    
    public static function output() {
        // Retrieve settings
        $social_enabled = get_option('wpdcsm_social_enabled', 1);
        $social_title = get_option('wpdcsm_social_title', 'Follow Us');
        $social_facebook = get_option('wpdcsm_social_facebook', '');
        $social_twitter = get_option('wpdcsm_social_twitter', '');
        $social_instagram = get_option('wpdcsm_social_instagram', '');
        $social_linkedin = get_option('wpdcsm_social_linkedin', '');
        $social_youtube = get_option('wpdcsm_social_youtube', '');
        $social_pinterest = get_option('wpdcsm_social_pinterest', '');
        $social_tiktok = get_option('wpdcsm_social_tiktok', '');
        $social_github = get_option('wpdcsm_social_github', '');
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Social Media Settings', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Add your social media links to display on the coming soon page.', 'dream-coming-soon'); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_social">
                <?php wp_nonce_field('wpdcsm_save_social'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_enabled"><?php echo esc_html__('Enable Social Media', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpdcsm_social_enabled" id="wpdcsm_social_enabled" value="1" <?php checked(1, $social_enabled); ?>>
                            <label for="wpdcsm_social_enabled"><?php echo esc_html__('Show social media links', 'dream-coming-soon'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_title"><?php echo esc_html__('Title', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_social_title" id="wpdcsm_social_title" value="<?php echo esc_attr($social_title); ?>" class="regular-text">
                            <p class="description"><?php echo esc_html__('Title displayed above social media icons (leave empty to hide)', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_facebook"><?php echo esc_html__('Facebook URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_facebook" id="wpdcsm_social_facebook" value="<?php echo esc_attr($social_facebook); ?>" class="regular-text" placeholder="https://facebook.com/yourpage">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_twitter"><?php echo esc_html__('Twitter/X URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_twitter" id="wpdcsm_social_twitter" value="<?php echo esc_attr($social_twitter); ?>" class="regular-text" placeholder="https://twitter.com/yourhandle">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_instagram"><?php echo esc_html__('Instagram URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_instagram" id="wpdcsm_social_instagram" value="<?php echo esc_attr($social_instagram); ?>" class="regular-text" placeholder="https://instagram.com/yourhandle">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_linkedin"><?php echo esc_html__('LinkedIn URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_linkedin" id="wpdcsm_social_linkedin" value="<?php echo esc_attr($social_linkedin); ?>" class="regular-text" placeholder="https://linkedin.com/company/yourcompany">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_youtube"><?php echo esc_html__('YouTube URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_youtube" id="wpdcsm_social_youtube" value="<?php echo esc_attr($social_youtube); ?>" class="regular-text" placeholder="https://youtube.com/c/yourchannel">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_pinterest"><?php echo esc_html__('Pinterest URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_pinterest" id="wpdcsm_social_pinterest" value="<?php echo esc_attr($social_pinterest); ?>" class="regular-text" placeholder="https://pinterest.com/yourprofile">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_tiktok"><?php echo esc_html__('TikTok URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_tiktok" id="wpdcsm_social_tiktok" value="<?php echo esc_attr($social_tiktok); ?>" class="regular-text" placeholder="https://tiktok.com/@yourhandle">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_social_github"><?php echo esc_html__('GitHub URL', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="url" name="wpdcsm_social_github" id="wpdcsm_social_github" value="<?php echo esc_attr($social_github); ?>" class="regular-text" placeholder="https://github.com/yourusername">
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <button type="submit" class="wpdcsm-save-button button-primary"><?php echo esc_html__('Save Settings', 'dream-coming-soon'); ?></button>
                </p>
            </form>
        </div>
        <?php
    }
}

