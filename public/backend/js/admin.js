$('.select2').select2();
$('.tags').tagsInput({
	width: 'auto',
	placeholderColor : '#123123',
});

//Delay time
var delay = (function(){
	var timer = 0;
	return function(callback, ms){
		clearTimeout (timer);
		timer = setTimeout(callback, ms);
	};
})();

// Preview Image
function readURL(input, id) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#'+id).attr('src', e.target.result);
			$('#'+id).css('display', 'block');
		}
		reader.readAsDataURL(input.files[0]);
	}
}

// tinyMCE Editor
var editor_config = {
	path_absolute : "/",
	selector: "textarea.my-editor",
	plugins: [
	"advlist autolink lists link image charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen",
	"insertdatetime media nonbreaking save table contextmenu directionality",
	"emoticons template paste textcolor textcolor colorpicker textpattern"
	],
	toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
	toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
	toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
	relative_urls: false,
	content_css: [
	'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	'{{ asset("css/tinymce.min.css") }}'],

	menubar: false,
	toolbar_items_size: 'small',

	style_formats: [{
		title: 'Bold text',
		inline: 'b'
	}, {
		title: 'Red text',
		inline: 'span',
		styles: {
			color: '#ff0000'
		}
	}, {
		title: 'Red header',
		block: 'h1',
		styles: {
			color: '#ff0000'
		}
	}, {
		title: 'Example 1',
		inline: 'span',
		classes: 'example1'
	}, {
		title: 'Example 2',
		inline: 'span',
		classes: 'example2'
	}, {
		title: 'Table styles'
	}, {
		title: 'Table row 1',
		selector: 'tr',
		classes: 'tablerow1'
	}],

	templates: [{
		title: 'Test template 1',
		content: 'Test 1'
	}, {
		title: 'Test template 2',
		content: 'Test 2'
	}],
	file_browser_callback : function(field_name, url, type, win) {
		var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
		var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

		var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
		if (type == 'image') {
			cmsURL = cmsURL + "&type=Images";
		} else {
			cmsURL = cmsURL + "&type=Files";
		}

		tinyMCE.activeEditor.windowManager.open({
			file : cmsURL,
			title : 'Filemanager',
			width : x * 0.8,
			height : y * 0.8,
			resizable : "yes",
			close_previous : "no"
		});
	}
};

tinymce.init(editor_config);
