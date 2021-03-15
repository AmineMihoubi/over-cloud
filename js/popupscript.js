document.getElementById('button').addEventListener('click', function() {
    document.querySelector('.bg-popup').style.display = 'flex';

});

document.querySelector('.btn-fermer').addEventListener('click', function() {
    document.querySelector('.bg-popup').style.display = 'none';
    location.reload();
});