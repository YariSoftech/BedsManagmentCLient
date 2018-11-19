<?php

/**
 * Entry point for controllers
 */
interface Controller
{
    function getAction($request);

    function postAction($request);

    function putAction($request);

    function deleteAction($request);

}