<script type="text/javascript" src="../CSSMenuWriter/cssmw0/menu.js"></script>
<style type="text/css" media="all">
/*@import url("../CSSMenuWriter/cssmw0/menu.css");*/
#menu holder {
	position: absolute;
}

/* New Menu CSS - Paul Canning, 07-09-2011 */
ul#cssmw0 {
    position: relative;
    margin: 0;
    padding: 0;
}
.cssLO > .cssLI:first-child {
    overflow: visible!important;
}
.level-0, .level-1 {
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 1000;
}

#cssmw0 a {
    padding: 10px;
    display: block;
    color: #FFF;
    text-decoration: none;
}
#cssmw0 a:hover {
    color: #efefef;
}
#cssmw0 li {
    list-style-type: none;
}
#cssmw0.level-0 li {
    display: block;
    float: left;
    margin: 0 20px;
    position: relative;
}
#cssmw0.level-0 li:hover ul.level-1 {
    display: block;
}
#cssmw0 .level-1 {
    background-color: #525252;
    display: none;
    position: absolute;
    width: 200px;
}
#cssmw0 .level-1 li {
    float: none;
    margin: 0;
}
#cssmw0 .level-1 li a:hover {
        background: #333333;
}
</style>
<!--[if lte IE 6]>
<style type="text/css" media="all">
@import url("../CSSMenuWriter/cssmw0/menu_ie.css");
</style>

<![endif]-->

<div id="menu">
  <?php require_once("../CSSMenuWriter/cssmw0/menu.php"); ?>
</div>
<div style="clear:both"></div>