jQuery(document).ready(function($) {

    // collect repeater control field value
    function repeater_value_refresh( _this ) {
        var controlValue = [], container =  _this.parents( ".blocks-repeater-control-wrap" )
        container.find( " > .clean-design-blog-block" ).each(function() {
            var newValue = {}, blockName = $(this).attr("block-name")
            newValue['name'] = blockName
            $(this).find( ".block-repeater-control-field" ).each(function() {
                var fieldValue, fieldName = $(this).data("name")
                if( $(this).attr("type") === 'checkbox' ) {
                    if( $(this).is(":checked") ) {
                        fieldValue = true;
                    } else {
                        fieldValue = false;
                    }
                } else {
                    fieldValue = $(this).val()
                }
                newValue[fieldName] = fieldValue
            })
            controlValue.push(newValue)
        })
        container.next( ".blocks-repeater-control" ).val( JSON.stringify( controlValue ) ).trigger("change")
    }
    
    // collect repeater field values
    $()
    $( ".blocks-repeater-control-wrap" ).on( "change keyup", ".clean-design-blog-block .block-repeater-control-field", function() {
        var _this = $(this)
        repeater_value_refresh(_this)
    })

    // radio image field
    $( ".blocks-repeater-control-wrap" ).on( "click", ".customize-radio-image-field label", function() {
        var _this = $(this), val = _this.data( "value" )
        _this.addClass( "selected" ).siblings( "label" ).removeClass( "selected" )
        _this.siblings( ".block-repeater-control-field" ).val( val )
        repeater_value_refresh(_this)
    })

    // toggle field
    $( ".blocks-repeater-control-wrap" ).on( "click", ".customize-toggle-field .toggle-button", function() {
        $(this).next("input[type='checkbox']").trigger('click')
        $(this).parent().toggleClass( "checked-toggle-control" )
        repeater_value_refresh($(this))
    })

    // multicheckbox field
    $( ".customize-multicheckbox-field" ).on( "click, change", ".multicheckbox-content input", function() {
        var _this = $(this), parent = _this.parents( ".customize-multicheckbox-field" ), currentVal, currentFieldVal = parent.find( ".block-repeater-control-field" ).val();
        currentFieldVal = JSON.parse( currentFieldVal )
        currentVal = _this.val();
        if( _this.is(":checked") ) {
            if( currentFieldVal != 'null' ) {
                currentFieldVal.push(currentVal)
            }
        } else {
            if( currentFieldVal != 'null' ) {
                currentFieldVal.splice( $.inArray( currentVal, currentFieldVal ), 1 );
            }
        }
        parent.find( ".block-repeater-control-field" ).val(JSON.stringify(currentFieldVal))
        repeater_value_refresh(_this)
    })

    // clone block
    $( ".blocks-repeater-control-wrap" ).on( "click", ".clone-block", function() {
        var _this = $(this)
        var clonedBlock = _this.prev().clone();
        //clonedBlock.find( ".remove-block" ).show()
        _this.before( clonedBlock )
        repeater_value_refresh(_this)
    })

    // add new block
    $( ".blocks-repeater-control-wrap" ).on( "click", ".add-new-block", function() {
        var _this = $(this)
        _this.next().slideToggle(function(){
            _this.find("> span").toggle()
        });
    })

    // on click block name list
    $( ".blocks-repeater-control-wrap" ).on( "click", ".block-name-list li", function() {
        var _this = $(this),
        newBlock = _this.next()
        _this.parents( ".block-name-list" ).slideUp().hide()
        _this.parents( ".block-name-list" ).siblings( ".add-new-block" ).find("> span").toggle()
        _this.parents( ".block-name-list" ).siblings( ".clone-block" ).before(newBlock)
        repeater_value_refresh(_this)
    })

    // trigger block content - block content show/hide
    $( ".blocks-repeater-control-wrap" ).on( "click", ".content-trigger", function() {
        var _this = $(this)
        _this.next().slideToggle(function() {
            _this.parent().toggleClass("open")
        });
        _this.find( ".block-header-icon i" ).toggleClass( "fa-chevron-up fa-chevron-down" );
    })

    $( ".blocks-repeater-control-wrap" ).on( "click", ".clean-design-blog-block .close-block", function() {
        var _this = $(this)
        _this.parents(".clean-design-blog-block").find( ".block-content-wrap" ).slideUp( "normal", function() {
            _this.parents(".clean-design-blog-block").toggleClass("open").find( ".block-header-icon i" ).toggleClass( "fa-chevron-up fa-chevron-down" );
        });
    })

    // remove block
    $( ".blocks-repeater-control-wrap" ).on( "click", ".clean-design-blog-block .remove-block", function() {
        var _this = $(this), blockelement = _this.parents(".clean-design-blog-block"), par = blockelement.siblings( ".add-new-block" )
        blockelement.find( ".block-content-wrap" ).slideUp( "normal", function() {
            $(this).parent().remove();
            repeater_value_refresh( par )
        });
        _this.parents(".clean-design-blog-block").find( ".block-header-icon i" ).toggleClass( "fa-chevron-up fa-chevron-down" );
    })

    // sortable blocks 
    // change block order
    $(".blocks-repeater-control-wrap").sortable({
        orientation: "vertical",
        items: "> .clean-design-blog-block",
        update: function (event, ui) {
            repeater_value_refresh( $(this).find( ".add-new-block" ) );
            $(this).find( " > .clean-design-blog-block .remove-block" ).show()
            $(this).find( ".clean-design-blog-block:first .remove-block" ).hide()
        }
    });
})