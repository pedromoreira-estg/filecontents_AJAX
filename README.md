filecontents_AJAX
==============

Example worked at TP classes.

Given a directory on the server,
gets all file entries and displays them.

If clicked, the file contents (expectably text) is request
via AJAX and the page is updated to show the file contents.

clicks toggles the file contents (shown / not shown)

* [files] -- directory with files
* [getfilecontentsGET.php] -- receives a 'f' parameter (GET) with filename and returns filecontent
* [getfilecontentsGET.php] -- receives a 'f' parameter (POST) with filename and returns filecontent
* [listfilesGET.php] -- list directory entries, requests (AJAX - GET) file content on demand (click)
* [listfilesPOST.php] -- list directory entries, requests (AJAX - POST) file content on demand (click)


Author
------------
SIR - ESTG - IPVC
(c) Pedro Moreira 2012
