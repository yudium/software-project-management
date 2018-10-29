define('global_functions', ['jquery'], function($) {

    return {
        /**
        * Remove non-numeric character from str.
        *
        * created for using with input mask jquery. Although jQuery input mask has
        * .cleanVal() method but it doesn't work on dynamic input field (not really
        * sure, too lazy for make sure it).
        */
        'cleanValMask': (str) => {
            return Number( str.replace(/\D/g, '') );
        },
    }
});
