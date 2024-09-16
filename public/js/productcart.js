const oneclickBtn = document.getElementById('item_oneclick');
const popup = document.getElementById('popup');
const close_popup = document.getElementById('close_popup');
const popup_box = document.getElementById('popup_box');
oneclickBtn.addEventListener('click', (e) => {
    popup.style.display = 'block';
})

close_popup.addEventListener('click', (e) => {
    popup.style.display = 'none';
})

