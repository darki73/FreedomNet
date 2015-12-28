
/**
 * Open and close the game dialog box.
 *
 * @param object node
 * @param string target
 */
function openGameDialog(node, target) {
    node = $(node);
    target = $(target);

    if (target.is(':visible')) {
        node.removeClass('opened');
        target.hide();
    } else {
        $("#game-selections .game-selection").removeClass('opened');
        $(".game-selection-dialog").hide();

        node.addClass('opened');
        target.show();
    }
}

/**
 * Open up the sample email on the security theft page.
 *
 * @param string id
 */
function openSampleEmail(id) {
    var wrapper = $('#phishing-wrapper');

    if (Core.isIE(6) || Core.isIE(7)) {
        wrapper.show();
        $('.phishing-sample').hide();
        $('#sample-email-'+ id).show();

    } else {
        if (wrapper.is(':hidden')) {
            wrapper.show();
            $('#sample-email-'+ id).slideDown();
        } else {
            $('.phishing-sample:visible').slideUp("normal", function() {
                $('#sample-email-'+ id).slideDown();
            });
        }
    }
}

/**
 * Highlight the notes in the sample email.
 *
 * @param int zone
 * @param int no
 */
function highlightNote(zone, no) {
    var note = $('#note_'+ zone +'-'+ no);
    var text = $('#notetext_'+ zone +'-'+ no);

    if (note.hasClass('active')) {
        note.removeClass('active');
        text.removeClass('active');
    } else {
        note.addClass('active');
        text.addClass('active');
    }
}

/**
 * Shows the hidden phishing email section on the security theft page
 */
function showPhishingMail() {
    $('#hidden-mail').show();
    $('#ingame-mail-header').addClass('adjusted-bg');
    $('#ingame-mail-footer').show();

    hideChat();
}
function hideMail() {
    $('#hidden-mail').hide();
    $('#ingame-mail-header').removeClass('adjusted-bg');
    $('#ingame-mail-footer').hide();
}
function showPhishingIngame() {
    $('#hidden-chat').show();
    $('#ingame-chat-header').addClass('adjusted-bg');
    $('#ingame-chat-footer').show();

    hideMail();
}
function hideChat() {
    $('#hidden-chat').hide();
    $('#ingame-chat-header').removeClass('adjusted-bg');
    $('#ingame-chat-footer').hide();
}
/**
 * Shows / hides phishing mail description
 */
function toggleMailDescription() {
    $('#true-mail-fade').toggle();
    $('#true-mail-normal').toggle();
}