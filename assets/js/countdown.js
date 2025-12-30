(function($) {
    'use strict';
    
    function updateCountdown() {
        $('.wpdcsm-countdown').each(function() {
            var $countdown = $(this);
            var targetTimestamp = parseInt($countdown.data('target'));
            
            if (!targetTimestamp) {
                return;
            }
            
            var now = new Date().getTime();
            var distance = targetTimestamp - now;
            
            if (distance < 0) {
                $countdown.find('.wpdcsm-days').text('0');
                $countdown.find('.wpdcsm-hours').text('0');
                $countdown.find('.wpdcsm-minutes').text('0');
                $countdown.find('.wpdcsm-seconds').text('0');
                return;
            }
            
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            $countdown.find('.wpdcsm-days').text(days);
            $countdown.find('.wpdcsm-hours').text(hours < 10 ? '0' + hours : hours);
            $countdown.find('.wpdcsm-minutes').text(minutes < 10 ? '0' + minutes : minutes);
            $countdown.find('.wpdcsm-seconds').text(seconds < 10 ? '0' + seconds : seconds);
        });
    }
    
    // Update countdown immediately
    updateCountdown();
    
    // Update countdown every second
    setInterval(updateCountdown, 1000);
    
})(jQuery);

