document.addEventListener('DOMContentLoaded', function(event)
{
    var onTransitionEnd = function()
    {
        var body = document.body;
        var page = document.getElementById('page-wrapper');

        body.classList.remove('animating');
        body.classList.remove('left');
        body.classList.remove('right');
        body.classList.toggle('menu-visible');

        page.transitionend = null;
        page.webkitTransitionEnd = null;
        page.otransitionend = null;
        page.MSTransitionEnd = null;
    };

    document.getElementById('cool-menu-toggle').addEventListener('click', function(e)
    {
        e.preventDefault();

        var body = document.body;
        var page = document.getElementById('page-wrapper');

        body.classList.add('animating');
        body.classList.add(body.classList.contains('menu-visible') ? 'right' : 'left');

        if (page.addEventListener)
        {
            page.addEventListener('transitionend', onTransitionEnd, false);
            page.addEventListener('webkitTransitionEnd', onTransitionEnd, false);
            page.addEventListener('otransitionend', onTransitionEnd, false);
            page.addEventListener('MSTransitionEnd', onTransitionEnd, false);
        }
        else
        {
            page.attachEvent('transitionend', onTransitionEnd);
            page.attachEvent('webkitTransitionEnd', onTransitionEnd);
            page.attachEvent('otransitionend', onTransitionEnd);
            page.attachEvent('MSTransitionEnd', onTransitionEnd);
        }
    });
});

var modal = document.getElementById('mod-div');
var modalGood = document.getElementById('mod-good');
var modalBad = document.getElementById('mod-bad');
var modalReview = document.getElementById('mod-review');

var reviewsHidder = document.getElementById('reviews-hidder');

$('.sale-buttons').on('click', function()
{
    var idSales = this.getAttribute('data-id');
    $(modal).find('.price-id').val(idSales);
    var nameSales = this.getAttribute('data-name');
    document.getElementById('price-name').innerHTML = nameSales;
    var priceSiles = this.getAttribute('data-price');
    document.getElementById('price').innerHTML = priceSiles;
    modal.style.display = "block";
});

$('.review-ok').on('click', function()
{
    modalReview.style.display = "block";
});

$('.close').on('click', function()
{
    modal.style.display = "none";
    modalGood.style.display = "none";
    modalBad.style.display = "none";
    modalReview.style.display = "none";
});

window.onclick = function(event)
{
    if (event.target == modal || event.target == modalGood || event.target == modalBad || event.target == modalReview)
    {
        modal.style.display = "none";
        modalGood.style.display = "none";
        modalBad.style.display = "none";
        modalReview.style.display = "none";
    }
}

$(function()
{
    $('img.lazy').lazyload(
    {
        effect: "fadeIn"
    });
});

// Кнопка покупки

$(modal).find('.sale-ok').on('click', function(e)
{
    e.preventDefault();
    var form_data = $("#form-ok").serializeArray();
    if (form_data[0].value == "" || form_data[1].value == "" || form_data[2].value == "")
    {
        alert('Заполните все поля');
        return;
    }
    else
    {
        formSend(form_data);
    }
});

function formSend(data)
{
    console.log('data', data);
    $.ajax(
    {
        url: '/send.php',
        type: 'POST',
        dataType: 'json',
        data,
        success: function(result)
        {
            console.log('result', result);
            if (result['resp'] != 'Bad')
            {
                modal.style.display = "none";
                modalGood.style.display = "block";
            }
            else
            {
                modal.style.display = "none";
                modalBad.style.display = "block";
            }
        }
    });
}

// Кнопка оставить отзыв

var revDoc = $('#form-feed');
var revButton = $(revDoc).find('.review-ok');

$(revButton).on('click', function(e)
{
    e.preventDefault();
    var form_data = $(revDoc).serializeArray();
    formReview(form_data);
});

function formReview(data)
{
    console.log('data', data);
    $.ajax(
    {
        url: '/result.php',
        type: 'POST',
        data,
        success: function(result)
        {
            console.log('result', result);
            if (result['resp'] != 'Bad')
            {
                reviewsHidder.style.display = "none";
                modalReview.style.display = "block";
            }
            else
            {
                modalBad.style.display = "block";
            }
        }
    });
}

// Добавление нового отзыва

$('#review-ok').on('click', function(e)
{
    var textReview = document.getElementById('text-review').value;
    var reviewer = document.getElementById('person').value;

    var div = $('<div/>',
    {
        'class': 'feedback'
    });

    $('<br/>').appendTo(div);
    $('<p/>').html(textReview).appendTo(div);
    $('<p/>',
    {
        'class': 'feed-name'
    }).html(reviewer).appendTo(div);

    div.appendTo($('#reviews-block'));

    document.getElementById('text-review').value = "";
    document.getElementById('person').value = "";

    e.preventDefault();
    return false;
});

// Слик-слайдер

$(document).ready(
    function()
    {
        $('.one-time').slick(
        {
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            slidesToShow: 1,
            cssEase: 'linear',
            arrows: false,
        });
    }
);