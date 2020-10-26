

$("#date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today"
})

$("#train_date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    defaultDate: "today"
})
$("#flight_date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    defaultDate: "today"
})
$("#flight_return_date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    defaultDate: "today"
})

$("#cabs_date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    defaultDate: "today"
})

$("#cabs_return_date").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    defaultDate: "today"
})

$( '#cabs_pick_time' ).flatpickr({
    noCalendar: true,
    enableTime: true,
    dateFormat: 'h:i K',
    defaultDate: Date.now()
});


$("#class_apply").click(function(){
    $(".flight_class").css("display", "none");
    var val = $("#flight_class_option").find(":selected").val();
    $("label[for='flight_class'] .name").text(val);

})

$("#service_nav li a").click(function(e){
    e.preventDefault();
    $("#service_nav li a").removeClass('active');
    $(this).addClass('active');
    var val = $(this).attr("id");
    $(".option").removeClass("option_show");
    $("#option_"+val).addClass('option_show');
    console.log(val)
})

var slider = tns({
    "container": "#slider",
    "items": 1,
    "slideBy": "page",
    "mouseDrag": true,
    "swipeAngle": false,
    "speed": 400,
    "gutter": 20,
    "controlsContainer": "#custom_control",
    "nav": false,
    "responsive": {
        640: {
          "edgePadding": 20,
          "gutter": 20,
          "items": 2
        },
        700: {
          "gutter": 30
        },
        1200: {
          "items": 3
        }
      }
});

$("label").click(function(){
    var val = $(this).attr('for');
    $("."+val).css('display', 'block');
})

$(".icon-input input").focusout(function(){
    var target = $(this).attr('id');
    if($(this).val() != ""){
       var val = $(this).val();
       $("label[for='"+target+"'] .name").text(val);
    }
    $("."+target).css("display", "none");
    
    $(".icon-input").css("display", "none");
    if(target == undefined){
        var id = $(this).closest(".icon-input").find(".flatpickr-input").attr("id");
        var val = $(this).closest(".icon-input").find(".flatpickr-input").val();
        $("label[for='"+id+"'] .name").text($(this).val())
    }
})
$(".icon-input select").focusout(function(){
    var target = $(this).attr('id');
    if($(this).val() != ""){
       var val = $(this).val();
       $("label[for='"+target+"'] .name").text(val);
    }

    $("."+target).css("display", "none");
})


$(".input.active").focusout(function(){
    $("label[for='date'] .name").text($(".input.active").val());
    $(".input.active").css('display', 'none')
    console.log($(".input.active").val())
})


$("#cabs_pick_time").change(function(){
    var val = $("#cabs_pick_time").val();
    $("label[for='cabs_pick_time'] .name").text(val);
})

// $(".btn_search").click(function(){
//     $("#result_bus").addClass('result_area_show')
//     console.log("show")
// })



