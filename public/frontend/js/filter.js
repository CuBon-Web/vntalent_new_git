// const { integer } = require("vuelidate/lib/validators");

function toggleFilter(e){
    if (e.checked) {
       e.removeAttribute("checked");
    } else {
       e.setAttribute("checked", "checked");
    }
    var page = $('#hidden_page').val();
    fetch_data(page)
       
}
function action(){
    var page = $('#hidden_page').val();
    fetch_data(page);
}

function priceRange(){
    var page = $('#hidden_page').val();
    fetch_data(page)
}
   function fetch_data(page){
    var checkedBoxes = getCheckedBoxes("fillter");
    var sortby = document.getElementById("sortBy").value;
    var keyword = document.getElementById("keyword").value;
    var cate = document.getElementById("cate_slug").value;
    var rank = document.getElementById("rank").value;
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/filter.html?page="+page+"",
        method: "POST",
        data: {
            'cate': cate,
            'sortby':sortby,
            'rank':rank,
            'keyword':keyword,
            'fillter':checkedBoxes
        },
        success: function (response) {
          $(".product-list-filter").html(response.html);
          var element = document.getElementById("pagination_main");
          if (element !== null){
            element.classList.add("d-none");
            }
 
        },
    });
   }

   $(document).on('click', '#pagination .pagination a', function(event){
        event.preventDefault();
        var checkedBoxes = getCheckedBoxes("fillter");
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        fetch_data(page);
   });

   function getCheckedBoxes(chkboxName) {
    var checkboxes = document.getElementsByName('fillter');
    var checkboxesChecked = [];
    for (var i=0; i<checkboxes.length; i++) {
       if (checkboxes[i].checked) {
          checkboxesChecked.push(checkboxes[i].value);
       }
    }
    return checkboxesChecked.length > 0 ? checkboxesChecked : null;
    }