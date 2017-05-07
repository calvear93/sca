function get_cookie( cookie_name ) {
    var results = document.cookie.match( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
}

function set_cookie( cookie_name, value ) {
  document.cookie = cookie_name +'='+ value +'; Path=/;';
}

function delete_cookie( cookie_name ) {
  document.cookie = cookie_name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}