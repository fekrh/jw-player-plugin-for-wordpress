function JWP6Admin() {

    var $ = jQuery;

    var j = this;

    this.parse_query_string = function (url) {
        var params = [], qs = url.split('?');
        if (qs.length > 1) {
            qs = qs[1].split('&');
            for (item in qs) {
                item = qs[item].split('=');
                params[item[0]] = (item.length > 1) ? item[1] : null;
            }
        }
        return params;
    };
    
    this.player_copy = function () {
        $('a.jwp6_copy').bind('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            function get_name(wrong_name) {
                var name, message;
                message = "What is the name for this new player?"
                if ( wrong_name )
                    message = message + "\nPlease note you can only use letters, digit, '_' and '-'.";
                var name = prompt(message);
                if (name && name.match(/^[a-z0-9_-]*$/i)) {
                    return name;
                } else if ( name ) {
                    return get_name(name);
                }
                return false;
            }
            var name = get_name();
            if ( name ) {
                var params = j.parse_query_string(e.target.href);
                $('#new_player_name').val(name);
                $('#copy_from_player').val(params['player_id']);
                $('#add_player_form').submit();
            }
            return false;
        });
    };

    this.player_delete = function () {
        $('a.jwp6_delete').bind('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            if (confirm('Are you sure you want to delete this player?')) {
                window.location.href = e.target.href;
            }
            return false;
        });
    };

}


