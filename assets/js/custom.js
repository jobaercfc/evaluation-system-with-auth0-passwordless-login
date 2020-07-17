$(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //var active_id = $('.tab-content .active').attr('id');

        var total_tabs = $('.tab-pane').length;

        var current_tab = $(this).index('a[data-toggle="tab"]');
        current_tab += 1;
        let showText = ((((100 * current_tab) / total_tabs) * total_tabs) / 100) + " / " + total_tabs;

        $("#fluid-meter").html("");
        var fm = new FluidMeter();
        fm.init({
            targetContainer: document.getElementById("fluid-meter"),
            fillPercentage: (100 * current_tab) / total_tabs,
            options: {
                fontSize: "30px",
                drawPercentageSign: false,
                drawBubbles: false,
                size: 150,
                borderWidth: 19,
                showText: showText,
                backgroundColor: "#e2e2e2",
                foregroundColor: "#fafafa",
                foregroundFluidLayer: {
                    fillStyle: "#16E1FF",
                    angularSpeed: 30,
                    maxAmplitude: 5,
                    frequency: 30,
                    horizontalSpeed: -20
                },
                backgroundFluidLayer: {
                    fillStyle: "#4F8FC6",
                    angularSpeed: 100,
                    maxAmplitude: 3,
                    frequency: 22,
                    horizontalSpeed: 20
                },
            }
        });

    });
    $('.mastery-class').click(function(){
        var value = $(this).val();
        var itemId = $(this).attr('itemid');
        var params = {
            "item_id" : itemId,
            "selected_master_level" : value
        };
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                params : params,
                set_mastery_level : 1
            },
            success: function(data) {
                console.log(data);
            }
        })
    });
    $('.interest-class').click(function(){
        var value = $(this).val();
        var itemId = $(this).attr('itemid');
        var params = {
            "item_id" : itemId,
            "selected_interest_level" : value
        };
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                params : params,
                set_interest_level : 1
            },
            success: function(data) {
                console.log(data);
            }
        })
    });
    setDefaultTab();
    function setDefaultTab() {
        var names = [];
        $("form").each(function() {
            names.push(this.id);
        });
        var defaultTabId = 0;
        for (var i = 0; i < names.length; i++) {
            var active_id = names[i];
            defaultTabId = active_id.replace('form_category_', '');
            var radioClassName = '.'+names[i]+'_input';
            active_id = '#'+names[i];
            var allRadio = $(active_id).find(radioClassName);
            var dataString = $(active_id).serializeArray();

            defaultTabId = parseInt(defaultTabId);
            if(allRadio.length != dataString.length) {
                break;
            }
        }
        var navDefault = '.nav-class-'+defaultTabId+' a';
        $(navDefault).click();
    }
});

