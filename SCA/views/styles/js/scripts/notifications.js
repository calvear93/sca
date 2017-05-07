function notification( icon, title, msg, type ) {
    $.notify({
        // Options
        icon: icon,
        title: '<strong>' + title + '</strong><br>',
        message: msg,
        target: '_blank'
    },{
        // Settings
        element: 'body',
        position: null,
        type: type,
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 6000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: 'pause',
        animate: {
            enter: 'animated bounceInDown',
            exit: 'animated bounceOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
    });
}

function success_notification( title, msg ) {
    notification( 'glyphicon glyphicon-ok-sign', title, msg, 'success' );
}

function info_notification( title, msg ) {
    notification( 'glyphicon glyphicon-info-sign', title, msg, 'info' );
}

function warning_notification( title, msg ) {
    notification( 'glyphicon glyphicon-exclamation-sign', title, msg, 'warning' );
}

function danger_notification( title, msg ) {
    notification( 'glyphicon glyphicon-remove-sign', title, msg, 'danger' );
}