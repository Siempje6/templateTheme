/*(function($){

    acf.add_action('ready_field/type=color_picker', function($field){

        if($field.hasClass('full-pro-picker')) return;
        $field.addClass('full-pro-picker');

        var $input = $field.find('input[type=hidden]');
        $input.hide(); // Verberg originele input

        // Voeg open picker knop toe
        var $openBtn = $('<button type="button" class="picker-open">Kleur Picker openen</button>');
        $field.append($openBtn);

        // Voeg picker popup toe
        var html = `
            <div class="picker-popup">
                <div class="picker-square"></div>
                <div class="picker-slider"></div>
                <div class="picker-palette"></div>
                <button type="button" class="picker-clear">Wissen</button>
                <button type="button" class="picker-close">Sluiten</button>
            </div>
        `;
        $field.append(html);

        var $popup = $field.find('.picker-popup');
        var $square = $field.find('.picker-square');
        var $slider = $field.find('.picker-slider');
        var $palette = $field.find('.picker-palette');
        var $clear = $field.find('.picker-clear');
        var $close = $field.find('.picker-close');

        // Init kleur
        var hue = 0, sat = 100, light = 50;

        // HSL -> Hex converter
        function hslToHex(h,s,l){
            s/=100; l/=100;
            let c=(1-Math.abs(2*l-1))*s;
            let x=c*(1-Math.abs((h/60)%2-1));
            let m=l-c/2;
            let r=0,g=0,b=0;
            if(h<60){r=c;g=x;b=0;}
            else if(h<120){r=x;g=c;b=0;}
            else if(h<180){r=0;g=c;b=x;}
            else if(h<240){r=0;g=x;b=c;}
            else if(h<300){r=x;g=0;b=c;}
            else{r=c;g=0;b=x;}
            r=Math.round((r+m)*255); g=Math.round((g+m)*255); b=Math.round((b+m)*255);
            return "#"+((1<<24)+(r<<16)+(g<<8)+b).toString(16).slice(1);
        }

        function updateColor(){
            var hex = hslToHex(hue,sat,light);
            $square.css('background-color', hex);
            $input.val(hex).trigger('change');
        }

        // Open / close picker
        $openBtn.on('click', function(){ $popup.fadeToggle(150); });
        $close.on('click', function(){ $popup.fadeOut(150); });

        // Palette kleuren
        var colors = ['#FF4C4C','#FFA64C','#FFFF4C','#A6FF4C','#4CFF4C','#4CE5FF','#4C4CFF','#8224E3'];
        colors.forEach(function(c){
            var $c = $('<div class="palette-block"></div>').css('background-color',c);
            $palette.append($c);
            $c.on('click', function(){
                $input.val(c).trigger('change');
                $square.css('background-color',c);
            });
        });

        // Clear knop
        $clear.on('click', function(){
            $input.val('').trigger('change');
            $square.css('background-color','#ffffff');
        });

        // Interactie kleurvlak
        $square.on('mousedown', function(e){
            e.preventDefault();
            var rect = $square[0].getBoundingClientRect();
            function move(e){
                var x = Math.max(0, Math.min(rect.width, e.clientX - rect.left));
                var y = Math.max(0, Math.min(rect.height, e.clientY - rect.top));
                sat = Math.round((x/rect.width)*100);
                light = Math.round(100 - (y/rect.height)*100);
                updateColor();
            }
            move(e);
            $(document).on('mousemove.picker', move);
            $(document).on('mouseup.picker', function(){ $(document).off('.picker'); });
        });

        // Slider interactie
        $slider.on('mousedown', function(e){
            e.preventDefault();
            var rect = $slider[0].getBoundingClientRect();
            function move(e){
                var y = Math.max(0, Math.min(rect.height, e.clientY - rect.top));
                hue = Math.round((y/rect.height)*360);
                updateColor();
            }
            move(e);
            $(document).on('mousemove.slider', move);
            $(document).on('mouseup.slider', function(){ $(document).off('.slider'); });
        });

        // Init kleur
        updateColor();

    });
})(jQuery);
*/