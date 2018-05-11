//var baseURL ="http://1900.xstructiep.com/duongnh/alogiasu";
var getUrl = window.location;
//var baseURL = "http://"+getUrl.host+"/duongnh/alogiasu";
//var baseURL = "http://"+getUrl.host;
var baseURL = "http://"+getUrl.host;
function ckeditorFull (name) {
    var editor = CKEDITOR.replace(name ,{
        uiColor : '#9AB8F3',
        language:'vi',
        enterMode   : Number(2),
        height: "450px",
        //filebrowserBrowseUrl : baseURL+'/fck3/ckfinder/ckfinder.html',
        //filebrowserUploadUrl : baseURL+'/fck3/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageBrowseUrl : baseURL+'/admin/fck3/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : baseURL+'/admin/fck3/ckfinder/ckfinder.html?Type=Flash',
        filebrowserImageUploadUrl : baseURL+'/admin/fck3/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : baseURL+'/admin/fck3/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        line_height:'1px',
        toolbar:[
            ['Source'],
           
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField'],
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['Link','Unlink','Anchor'],
            ['Image','Flash','Iframe','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
            ['Styles','Format','Font','FontSize'],
            ['TextColor','BGColor'],
            ['ShowBlocks'],['Maximize']
        ]
        });
}

function ckeditorMini (name) {
    var editor = CKEDITOR.replace(name ,{
        uiColor : '#9AB8F3',
        language:'vi',
        toolbar:[
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
            ['Undo','Redo','-','RemoveFormat'],
            ['Bold','Italic','Underline'],
            ['Styles','Format','Font','FontSize'],
            ['Image','Flash','Iframe','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
            ['TextColor','BGColor','Maximize'],
        ]
        });
}