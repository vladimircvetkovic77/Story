$(document).ready(function() {


    $("#myDiv").on("click", ".treeLabel", function(event) {

        event.preventDefault();
        var value = event.target.id;

        $('.maintree-' + value).toggle();
        $('.treeMinus-' + value).toggle();
        $('.treePlus-' + value).toggle();

    });


    $("#myDiv").on("click", ".branchLabel", function(event) {
        event.preventDefault();
        var value = event.target.id;

        $('.branch-' + value).toggle();
        $('.branchPlus-' + value).toggle();
        $('.branchMinus-' + value).toggle();

    });

    $("#searchField").on('keyup', function() {
        var value = $(this).val();
        $.ajax({
            type: 'get',
            url: 'livesearch',
            data: {
                search: value

            },
            success: function(data) {

                $('#myDiv').html(data);
                console.log(data);

            }


        });

    });


    $("#myDiv").on("click", ".treeCheckBox", function(event) {
        var value = event.target.id;

        $(this).showButtons();

        if ($(this).is(':checked')) {

            $(".maintree-" + value).prop("checked", true);
             $(".maintree-" + value+'.branchCheckBox').show();
              $(".maintree-" + value+'.branchCheckBox2').hide();
               $(".maintree-" + value+'.branchCheckBox2').prop("checked", false);





        } else {
            $(".maintree-" + value).prop("checked", false);
        }
    });


    $("#myDiv").on("click", ".branchCheckBox", function(event) {
        var value = event.target.id;

        $(this).showButtons();


            if ($(this).is(':checked')) {

                $(".branchCb-" + value).prop("checked", true);

            } else {
                $(".branchCb-" + value).prop("checked", false);
            }

        
    });


    $("#myDiv").on("click", ".leafCheckBox", function(event) {
        var value = event.target.id;

        $(this).showButtons();

        if ($(this).is(':checked')) {


            var leafBrotherBoxes = $(this).parent().parent().parent().attr('id');
            var unchecked = 0;

            $('div#' + leafBrotherBoxes + ' input[type=checkbox]').each(function() {
                if (!$(this).is(":checked")) {

                    ++unchecked;

                }
            });

           
            if (unchecked) {

                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").prop("checked", true);



            } else {

                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").show();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").hide();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop("checked", true);
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").chechForParent();

            }

        } else {

            var checked = 0;
            var not_checked = 0;

            var leafBrotherBoxes = $(this).parent().parent().parent().attr('id');
            var testparent = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").attr('id');
           
            $('div#' + leafBrotherBoxes + ' input[type=checkbox]').each(function() {

                if ($(this).is(":checked")) {

                    ++checked;
                } else {
                    ++not_checked;
                }
            });

           

            if (checked) {

               
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop("checked", false);

                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", true);
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").prop("checked", true);

                if (not_checked) {

                    $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                    $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                    $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", false);
                    $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);
                    $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").chechForParent();

                }



            } else {

                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").show();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").hide();
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").chechForParent();


            }
        }


    });

    $("#myDiv").on("click", ".branchCheckBox", function treeCheck(event) {

        var value = event.target.id;

        $(this).showButtons();


        if ($(this).is(':checked')) {


            var branchBrotherBoxes = $(this).parent().parent().parent().attr('id');
            console.log(branchBrotherBoxes);

            var unchecked = 0;

            $('div#' + branchBrotherBoxes + ' input[name=branchBox]').each(function() {
                if (!$(this).is(":checked")) {

                    ++unchecked;

                }
            });
            console.log(unchecked); 
            if (unchecked) {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", true);

            } else {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", true);

            }

        } else {

            var checked = 0;
            var branchBrotherBoxes = $(this).parent().parent().parent().attr('id');

            $('div#' + branchBrotherBoxes + ' input[name=branchBox]').each(function() {

                if ($(this).is(":checked")) {

                    ++checked;
                }
            });



            if (checked) {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", true);


            } else {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);

            }
        }


    });



    $("#myDiv").on("click", ".branchCheckBox2", function(event) {
        event.preventDefault();
        var value = event.target.id;

        $(this).showButtons();

        $(this).hide();
        $('#' + value).show().prop("checked", true);

        if ($('#' + value).is(':checked')) {
            var value1 = event.target.id;

            $(".branchCb-" + value1).prop("checked", true);
            $(this).prop("checked", true);
            $(this).chechForParent();
             $(this).prop("checked", false);

        } else {
            $(".branchCb-" + value1).prop("checked", false);
        }

       
    });


    $("#myDiv").on("click", ".treeCheckBox2", function(event) {
        event.preventDefault();
        var value = event.target.id;

        $(this).showButtons();

        $(this).hide();
        $('#' + value).show().prop("checked", true);

        if ($('#' + value).is(':checked')) {
            var value1 = event.target.id;

            $(".maintree-" + value1).filter(".branchCheckBox").show();
            $(".maintree-" + value1).filter(".branchCheckBox").prop("checked", true);
            $(".maintree-" + value1).filter(".branchCheckBox2").hide();
            $(".maintree-" + value1).filter(".branchCheckBox2").prop("checked", false);


            $(".maintree-" + value1).prop("checked", true);

        } else {
            $(".maintree-" + value1).prop("checked", false);
        }


    });




    $.fn.chechForParent = function(event) {

        if ($(this).is(':checked')) {


            var branchBrotherBoxes = $(this).parent().parent().parent().attr('id');

            var unchecked = 0;

            $('div#' + branchBrotherBoxes + ' input[name=branchBox]').each(function() {
                if (!$(this).is(":checked")) {

                    ++unchecked;

                }
            });

           

            if (unchecked) {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", true);

            } else {

               
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", true);

            }

        } else {

            var checked = 0;
            var branchBrotherBoxes = $(this).parent().parent().parent().attr('id');

            $('div#' + branchBrotherBoxes + ' input[name=branchBox]').each(function() {

                if ($(this).is(":checked")) {

                    ++checked;
                }
            });

  

            if (checked) {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop("checked", true);


            } else {

                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop("checked", false);

            }
        }
    };

    $.fn.showButtons = function() {
        $('.btn-danger').show();
        $('.btn-success').show();
    };

    $.fn.hideButtons = function() {
        $('.btn-danger').hide();
        $('.btn-success').hide();
    };



    $("#myDiv").on("click", "#button1", function(event) {

        $(this).hideButtons();
        $('#button1').blur();


    });

    var selection = new Array();

    $("#myDiv").on("click", "#button2", function(event) {

        selection = [];
        $("#successMessage").empty();

        $('.selection').each(function() {
            if (this.checked) {
                selection.push($(this).val());
            }
        });

        $.each(selection, function(index, value) {
            $("#successMessage").append(value + '<br>');
        });

        $("#successMessage").show();
         $("#successMessageSpan").show();
        $('#button2').blur();

    });

    $(".buttons").on("click", "#button3", function(event) {

        $("#successMessage").hide();
         $("#successMessageSpan").hide();
        $('#button3').blur();

    });

    $(".buttons").on("click", "#button4", function(event) {

        $("#successMessage").show();
        $("#successMessageSpan").show();
        $('#button4').blur();


    });

});