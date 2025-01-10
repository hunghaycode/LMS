<?php
function limitText($text, $limit)
{
   return Str::limit($text, $limit, '...');
};