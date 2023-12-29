<?php
//Datepicker dose not translate on some instance when you are using plugins like translatepress for wordpress to make the website multillanguage. I hade same situation where my booking calender dose not work properly when switch to Greek language. 
//so i created simple solution as bellow to change the language of your UI datepicker as the selected language.

//add this code to your functions.php in your wordpress theme. 
function enqueue_datepicker_greek_localization() {
    // Enqueue jQuery UI i18n for localization
    wp_enqueue_script('jquery-ui-datepicker-i18n', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js', array('jquery-ui-datepicker'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_datepicker_greek_localization');


function add_inline_datepicker_localization_script() {

  // here im checking to run this code only on single page. you can remove the condition as needed.
	if (is_page(616)) {
    $current_language = get_locale();

    // Check if the current language is Greek ('el' or 'el_GR')
    if ($current_language == 'el' || $current_language == 'el_GR') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
              // in the configuarations im loading two months. you can change it as needed.
                setTimeout(function() {
                    if ($.datepicker) {
                        var options = $.extend({}, $.datepicker.regional['el'], {
                            dateFormat: "mm/dd/yy",
                            numberOfMonths: 2
                        });

                        $(".hasDatepicker").each(function() {
                            $(this).datepicker('destroy');
                            $(this).datepicker(options);
                        });
                    }
                }, 100); // Delay in milliseconds (1000ms = 1 second)
            });
        </script>
        <?php
    }
}
}
add_action('wp_footer', 'add_inline_datepicker_localization_script');



?>
