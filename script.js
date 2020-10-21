var modal = document.getElementById('modDiv');

$('.saleButtons').on('click', function()
{
    var idSales = this.getAttribute("data-id");
    modal.style.display = "block";
});

$('.close').on('click', function()
{
    modal.style.display = "none";
});

window.onclick = function(event)
{
    if (event.target == modal)
    {
        modal.style.display = "none";
    }
}