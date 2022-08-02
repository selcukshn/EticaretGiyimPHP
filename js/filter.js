const SITE_URL = "http://localhost/eticaret";
var lastfilter = "";
function ApplyFilters(filters) {
    const categoryid = $("input[name='categoryid']").val();
    var filterdata = { "CategoryId": categoryid };
    if (filters != "") {
        filterdata = { "filters": filters, "CategoryId": categoryid };
    }
    DisableFilterButton();
    $(".onload").show();
    var currentfilters = "";
    $.ajax({
        type: "post",
        url: SITE_URL + "/admin/backend/ajax.php?operation=applyfilters",
        data: filterdata,
        dataType: "json",
        success: function (data) {
            setTimeout(() => {
                $(".onload").hide();
                lastfilter = filters;
                if (data.error) {
                    alert(data.data);
                } else {
                    $("#product-list").html(data.data);
                    data.filters.forEach(a => {
                        currentfilters += `
                            <div class="current-filter-group">
                                <div class="current-filter">
                                    <h5>${a[0]}</h5>
                                    <span>${a[1]}</span>
                                </div>
                                <button filter="${a[2]}" type="button" class="remove-filter"><i class="fa fa-times"></i></button>
                            </div>
                            `;
                    });
                    console.log(data.filters);
                    $(".current-filters").html(currentfilters);
                    $(".pagination").html(data.pagination);
                    window.history.pushState("", "", data.getstring);
                }
            }, 500);
        }
    });
}
function ClearFilters() {
    const gender = $("select[name='gender']");
    const style = $("select[name='style']");
    const size = $("input[name='size']:checked");
    const minprice = $("input[name='minprice']");
    const maxprice = $("input[name='maxprice']");

    gender.prop("selectedIndex", 0);
    style.prop("selectedIndex", 0);
    size.prop("checked", false);
    minprice.val("");
    maxprice.val("");
    console.log("clear");
}

function EnableFilterButton() {
    $(".filter-apply button").prop("disabled", false);
}
function DisableFilterButton() {
    $(".filter-apply button").prop("disabled", true);
}
$(function () {
    $("select[name='gender']").change(function () {
        EnableFilterButton();
    })
    $("select[name='style']").change(function () {
        EnableFilterButton();
    })
    $("input[name='size']").change(function () {
        EnableFilterButton();
    })
    $("input[name='minprice']").change(function () {
        EnableFilterButton();
    })
    $("input[name='maxprice']").change(function () {
        EnableFilterButton();
    })


    $(".current-filters").click(function (e) {
        var pattern = null;
        const targetClass = e.target.classList;
        if (targetClass.contains("remove-filter")) {
            pattern = new RegExp(e.target.getAttribute("filter") + "=[A-Za-z0-9]+&?", "gi");
            e.target.parentElement.remove();
        }
        if (targetClass.contains("fa-times")) {
            pattern = new RegExp(e.target.parentElement.getAttribute("filter") + "=[A-Za-z0-9]+&?", "gi");
            e.target.parentElement.parentElement.remove();
        }
        if (pattern != null) {
            lastfilter = lastfilter.replace(pattern, "");
            if (lastfilter.substring(lastfilter.length - 1) == "&") {
                lastfilter = lastfilter.substring(0, lastfilter.length - 1);
            }
            ApplyFilters(lastfilter);
        }

    })
    $("#filters").on("submit", function (e) {
        const filters = $(this).serialize();
        e.preventDefault();
        ApplyFilters(filters);
        ClearFilters();
    })
})