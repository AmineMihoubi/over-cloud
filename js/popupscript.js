document.getElementById('button').addEventListener('click', function() {
    document.querySelector('.bg-popup').style.display = 'flex';

});

document. querySelector('.btn-fermer').addEventListener('click', function() {

    document.querySelector('.bg-popup').style.display = 'none';
    document.querySelector('.bg-popup2').style.display = 'none';

});
