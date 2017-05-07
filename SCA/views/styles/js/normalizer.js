function string_normalizer( str ) {
    var pieces = str.split(" ");
    for ( var i = 0; i < pieces.length; i++ ) {
        var j = pieces[i].charAt(0).toUpperCase();
        pieces[i] = j + pieces[i].substr(1);
    }
    return pieces.join(" ");
}

function run_normalizer( run ) {   
        return run.substring( 0, 2 ) + "." + run.substring( 2, 5 ) + "." + run.substring( 5, 8 ) + "-" + run.substring( 8 );
}