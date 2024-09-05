const replyToField = document.getElementById('reply-to-field');
const replyToRender = document.getElementById('replying-to');

function replyToThis(messageBody, messageId) {
    replyToField.value = messageId;
    replyToRender.innerText = 'Reply To:  ' + messageBody;
}