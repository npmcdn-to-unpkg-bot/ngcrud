<?php

$css_style="
body{
    background-color: #cccccc;
}
.".$_POST['projectName']."-content{
    width: 97%;
    margin-left: 23px;
    float: left;
    min-height: 600px;
    height: auto;
    padding:15px;
    background-color: white;
    box-shadow: 0px 0px 7px 0px;
    z-index: 888;
    margin-top: 7%;
}
.".$_POST['projectName']."-nav{
    width: 100%;
    height:65px;
    background-color: #555555;
    box-shadow: 0px 0px 10px 0px;
    padding: 20px 15px 0px 15px;
    color: #8C715C;
    font-size: 22px;
    font-weight: bold;
    z-index: 999;
    position: fixed;
    top:0;
    left:0;
}
";