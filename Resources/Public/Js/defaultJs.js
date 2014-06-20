
(function($){

        function verifyStyle(selector) {//http://stackoverflow.com/a/983817/579646
            var rules;
            var haveRule = false;

            if (typeof document.styleSheets != "undefined") {   //is this supported
                var cssSheets = document.styleSheets;

                outerloop:
                for (var i = 0; i < cssSheets.length; i++) {

                     //using IE or FireFox/Standards Compliant
                    rules =  (typeof cssSheets[i].cssRules != "undefined") ? cssSheets[i].cssRules : cssSheets[i].rules;

                     for (var j = 0; j < rules.length; j++) {
                         if (rules[j].selectorText == selector) {
                                 haveRule = true;
                                break outerloop;
                         }
                    }//innerloop

                }//outer loop
            }//endif

            return haveRule;
        }//eof

        <!-- BOOTSTRAP JS WITH LOCAL FALLBACK-->
        if(typeof($.fn.modal) === 'undefined') {document.write('<script src="<?=$path_js?>/bootstrap.min.js"><\/script>')}

        <!-- BOOTSTRAP CDN FALLBACK CSS-->
        $(document).ready(function() {

            if( verifyStyle('form-inline') )
            {
            	console.log('i try to include bootstrap css..');
                $("head").prepend("<link rel='stylesheet' href='<?=$path_css?>bootstrap.min.css' type='text/css' media='screen'>");
            }
            else
            {
            	console.log('bootstrap already loaded');
            }
        });
    })(jQuery);