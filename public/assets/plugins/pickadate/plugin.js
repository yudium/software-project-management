require.config({
    shim: {
        'pickadate': ['jquery'],
        'pickadate_date': ['jquery', 'pickadate'],
    },
    paths: {
        'pickadate': 'assets/plugins/pickadate/lib/picker',
        'pickadate_date': 'assets/plugins/pickadate/lib/picker.date',
    }
});
