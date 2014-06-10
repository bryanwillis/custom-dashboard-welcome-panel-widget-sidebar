<?php
/*
Plugin Name: Better Admin Post Editor
Plugin URI: http://wordpress.org/plugins/custom-dashboard-welcome-panel-widget-sidebar
Description: This plugin registers a new sidebar widget to be used on the ADMIN SIDE ONLY. When active it replaces the WP Welcome Panel Dashboard Widget.
Version: 0.2
Author: Bryan Willis
Author Email: businesscandid@gmail.com
License: Uses Filter table plugin @https://github.com/sunnywalker/jQuery.FilterTable/
Copyright (c) 2012 Sunny Walker <swalker@hawaii.edu>
*/

function enqueue_select2_jquery() {
    wp_register_style( 'select2css', 'http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all' );
    wp_register_script( 'select2', 'http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'select2css' );
    wp_enqueue_script( 'select2' );
    }
add_action( 'admin_enqueue_scripts', 'enqueue_select2_jquery' );


add_action( 'admin_print_footer_scripts', 'float_the_head', 999 );
function float_the_head() {
global $pagenow, $typenow;
    // PAGE IS EDIT AND TYPE IS PAGE OR POST , OR PAGE IS PLUGINS
if ( ( ( $pagenow == 'edit.php' ) && ($typenow == 'page' || $typenow == 'post') ) || ( $pagenow == 'plugins.php' ) ) {
   
    if ( wp_script_is( 'jquery', 'done' ) ) {

        ?>
<style type="text/css">
.select2-container {margin: 0 2px 0 2px;}
.tablenav.top #doaction, #doaction2, #post-query-submit {margin: 0px 4px 0 4px;}
</style>        
<script type='text/javascript'>
jQuery( document ).ready(
    function( $ ) {
        $( "select:visible" ).select2(); // Only fire on visible inputs to begin with.
        $( document.body ).on( "focus", ".ptitle,select",
            function ( ev ) {
                if ( ev.target.nodeName === "SELECT" ) {
                    // Fire for this element only
                    $( this ).select2({ width: "element" });
                } else {
                    // Fire again, but only for selects that haven't yet been select2'd
                    $( "select:visible" ).not( ".select2-offscreen" ).select2({
                        width: "element"
                    });
                }
            }
        );
    }
);
</script>                       
<style type="text/css">
.tableFloatingHeaderOriginal {background-color: #ffffff;}
</style>
<script type="text/javascript">
jQuery(function(){
    jQuery("table").stickyTableHeaders();
});
(function(e,t,n){"use strict";function s(n,s){var o=this;o.$el=e(n);o.el=n;o.$el.bind("destroyed",e.proxy(o.teardown,o));o.$window=e(t);o.$clonedHeader=null;o.$originalHeader=null;o.isSticky=false;o.leftOffset=null;o.topOffset=null;o.init=function(){o.options=e.extend({},i,s);o.$el.each(function(){var t=e(this);t.css("padding",0);o.$originalHeader=e("thead:first",this);o.$clonedHeader=o.$originalHeader.clone();o.$clonedHeader.addClass("tableFloatingHeader");o.$clonedHeader.css("display","none");o.$originalHeader.addClass("tableFloatingHeaderOriginal");o.$originalHeader.after(o.$clonedHeader);o.$printStyle=e('<style type="text/css" media="print">'+".tableFloatingHeader{display:none !important;}"+".tableFloatingHeaderOriginal{position:static !important;}"+"</style>");e("head").append(o.$printStyle)});o.updateWidth();o.toggleHeaders();o.bind()};o.destroy=function(){o.$el.unbind("destroyed",o.teardown);o.teardown()};o.teardown=function(){if(o.isSticky){o.$originalHeader.css("position","static")}e.removeData(o.el,"plugin_"+r);o.unbind();o.$clonedHeader.remove();o.$originalHeader.removeClass("tableFloatingHeaderOriginal");o.$originalHeader.css("visibility","visible");o.$printStyle.remove();o.el=null;o.$el=null};o.bind=function(){o.$window.on("scroll."+r,o.toggleHeaders);o.$window.on("resize."+r,o.toggleHeaders);o.$window.on("resize."+r,o.updateWidth)};o.unbind=function(){o.$window.off("."+r,o.toggleHeaders);o.$window.off("."+r,o.updateWidth);o.$el.off("."+r);o.$el.find("*").off("."+r)};o.toggleHeaders=function(){o.$el.each(function(){var t=e(this);var n=isNaN(o.options.fixedOffset)?o.options.fixedOffset.height():o.options.fixedOffset;var r=t.offset();var i=o.$window.scrollTop()+n;var s=o.$window.scrollLeft();if(i>r.top&&i<r.top+t.height()-o.$clonedHeader.height()){var u=r.left-s;if(o.isSticky&&u===o.leftOffset&&n===o.topOffset){return}o.$originalHeader.css({position:"fixed",top:n,"margin-top":0,left:u,"z-index":1});o.$clonedHeader.css("display","");o.isSticky=true;o.leftOffset=u;o.topOffset=n;o.updateWidth()}else if(o.isSticky){o.$originalHeader.css("position","static");o.$clonedHeader.css("display","none");o.isSticky=false}})};o.updateWidth=function(){if(!o.isSticky){return}var t=e("th,td",o.$originalHeader);e("th,td",o.$clonedHeader).each(function(n){var r,i=e(this);if(i.css("box-sizing")==="border-box"){r=i.outerWidth()}else{r=i.width()}t.eq(n).css({"min-width":r,"max-width":r})});o.$originalHeader.css("width",o.$clonedHeader.width())};o.updateOptions=function(t){o.options=e.extend({},i,t);o.updateWidth();o.toggleHeaders()};o.init()}var r="stickyTableHeaders";var i={fixedOffset:32};e.fn[r]=function(t){return this.each(function(){var n=e.data(this,"plugin_"+r);if(n){if(typeof t==="string"){n[t].apply(n)}else{n.updateOptions(t)}}else if(t!=="destroy"){e.data(this,"plugin_"+r,new s(this,t))}})}})(jQuery,window)
</script>
<style type="text/css">
td.alt { background-color: #ffc; background-color: rgba(255, 255, 0, 0.2); }
</style>
<script type="text/javascript"> 
!function(e){var t=e.fn.jquery.split("."),i=parseFloat(t[0]),a=parseFloat(t[1]);e.expr[":"].filterTableFind=2>i&&8>a?function(t,i,a){return e(t).text().toUpperCase().indexOf(a[3].toUpperCase())>=0}:jQuery.expr.createPseudo(function(t){return function(i){return e(i).text().toUpperCase().indexOf(t.toUpperCase())>=0}}),e.fn.filterTable=function(t){var i={autofocus:!1,callback:null,containerClass:"filter-table",containerTag:"p",hideTFootOnFilter:!1,highlightClass:"alt",inputSelector:null,inputName:"",inputType:"search",label:"Filter:",minRows:8,placeholder:"search this table",quickList:[],quickListClass:"quick",quickListGroupTag:"",quickListTag:"a",visibleClass:"visible"},a=function(e){return e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/</g,"&lt;").replace(/>/g,"&gt;")},l=e.extend({},i,t),n=function(e,t){var i=e.find("tbody");""===t?(i.find("tr").show().addClass(l.visibleClass),i.find("td").removeClass(l.highlightClass),l.hideTFootOnFilter&&e.find("tfoot").show()):(i.find("tr").hide().removeClass(l.visibleClass),l.hideTFootOnFilter&&e.find("tfoot").hide(),i.find("td").removeClass(l.highlightClass).filter(':filterTableFind("'+t.replace(/(['"])/g,"\\$1")+'")').addClass(l.highlightClass).closest("tr").show().addClass(l.visibleClass)),l.callback&&l.callback(t,e)};return this.each(function(){var t=e(this),i=t.find("tbody"),s=null,r=null,o=null,c=!0;"TABLE"===t[0].nodeName&&i.length>0&&(0===l.minRows||l.minRows>0&&i.find("tr").length>l.minRows)&&!t.prev().hasClass(l.containerClass)&&(l.filterSelector&&1===e(l.filterSelector).length?(o=e(l.filterSelector),s=o.parent(),c=!1):(s=e("<"+l.containerTag+" />"),""!==l.containerClass&&s.addClass(l.containerClass),s.prepend(l.label+" "),o=e('<input type="'+l.inputType+'" placeholder="'+l.placeholder+'" name="'+l.inputName+'" />')),l.autofocus&&o.attr("autofocus",!0),e.fn.bindWithDelay?o.bindWithDelay("keyup",function(){n(t,e(this).val())},200):o.bind("keyup",function(){n(t,e(this).val())}),o.bind("click search",function(){n(t,e(this).val())}),c&&s.append(o),l.quickList.length>0&&(r=l.quickListGroupTag?e("<"+l.quickListGroupTag+" />"):s,e.each(l.quickList,function(t,i){var n=e("<"+l.quickListTag+' class="'+l.quickListClass+'" />');n.text(a(i)),"A"===n[0].nodeName&&n.attr("href","#"),n.bind("click",function(e){e.preventDefault(),o.val(i).focus().trigger("click")}),r.append(n)}),r!==s&&s.append(r)),c&&t.before(s))})}}(jQuery);
</script>
<script type="text/javascript">
jQuery(document).ready(function($) {
        $('table').filterTable({
             filterSelector: '#post-search-input'
        });
});                                                                                                                     
</script>
<?php       
    }
  }
}
?>