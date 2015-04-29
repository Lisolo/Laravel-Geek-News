$(document).ready(function() {

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

	$('.vote-up').click(function() {

		var blogid = $(this).attr("blogid")
		var voteup = $(this).attr("vote-up")

		if (voteup == "true") {

			var data = parseInt($('#blog-count-' + blogid).html()) - 1
		    $('#blog-count-' + blogid).html(data);
		    $(this).attr("class", "vote-up btn btn-default btn-xs")
		    $.post('/vote_up_cancel/', {blog_id: blogid})
		    $(this).attr("vote-up", "false")

		} else {

			$.get('/vote_up/', {blog_id: blogid}, function (redirect) {
			    if (redirect) {
				    window.location.assign("/auth/login")
			    }
		    })

		    $(this).attr("class", "vote-up btn btn-primary btn-xs")
		    $(this).attr("vote-up", "true")
		    var data = parseInt($('#blog-count-' + blogid).html()) + 1
		    $('#blog-count-' + blogid).html(data)
		    $('#down-' + blogid).attr("class", "btn btn-default btn-xs")
		    $('#down-' + blogid).attr("vote-down", "false")
		    $.post('/vote_down_cancel/', {blog_id: blogid})    
	    }
	})

	$('.vote-down').click(function() {

		var blogid = $(this).attr("blogid")
		var votedown = $(this).attr("vote-down")

		if (votedown == "true") {

			var data = parseInt($('#blog-count-' + blogid).html()) + 1
			$('#blog-count-' + blogid).html(data);
			$(this).attr("class", "vote-down btn btn-default btn-xs")
		    $.post('/vote_down_cancel/', {blog_id: blogid})
		    $(this).attr("vote-down", "false")

		} else {

			$.get('/vote_down/', {blog_id: blogid}, function (redirect) {
			    
			    if (redirect) {
				    window.location.assign("/auth/login")
			    }
			    
			    var data = parseInt($('#blog-count-' + blogid).html()) - 1
		        $('#blog-count-' + blogid).html(data)
		    })
		    
			$(this).attr("class", "vote-down btn btn-primary btn-xs")
		    $(this).attr("vote-down", "true")
		    
		    $('#up-' + blogid).attr("class", "btn btn-default btn-xs")
		    $('#up-' + blogid).attr("vote-up", "false")
		    $.post('/vote_up_cancel/', {blog_id: blogid})
	    }
	})
    
	$('.vote-comment').click(function() {

		var commentid = $(this).attr("id")
		var vote = $(this).attr("vote")

		if (vote == "true") {

			var data = parseInt($('#comment-points-' + commentid).html()) - 1
		    $('#comment-points-' + commentid).html(data)
		    $(this).attr("class", "vote-comment btn btn-default btn-xs")
		    $.post('/vote_comment_cancel/', {comment_id: commentid})
		    $(this).attr("vote", "false")

		} else {

		    $(this).attr("class", "vote-comment btn btn-primary btn-xs")
		    $(this).attr("vote", "true")
		    
		    $.get('/vote_comment/', {comment_id: commentid}, function (redirect) {
			    
			    if (redirect) {
				    window.location.assign("/auth/login")
			    }

			    var data = parseInt($('#comment-points-' + commentid).html()) + 1
		        $('#comment-points-' + commentid).html(data)
		    })

		    
	    }
	})

	$('#search').keyup(function() {
		var html = ''
		var query = $(this).val()

		if (query) {

			$.get('/suggest-news/', {keyword: query}, function(data) {
			    for (var i in data) {
				    html += '<li><a href="goto/' + data[i]['id'] + '">' + data[i]['title'] +'</a></li>'
			    }
			    $('.nav.nav-list').html(html)
		    })

		} else {

			$('.nav.nav-list > li').remove()
		}
		
	})

    $('#add-tags').tagsInput({
    	width:'auto',
        onAddTag:function(tag){
            $.get('/add-tags/', {tag: tag})
        },
    })

    var $input = $('.form-fieldset > input');

    $input.blur(function (e) {
        $(this).toggleClass('filled', !!$(this).val());
    })

    dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Create an account": addUser,
            Cancel: function() {
               dialog.dialog( "close" );
            }
        },
        close: function() {
            form[ 0 ].reset();
            allFields.removeClass( "ui-state-error" );
        }
    });
    
    $( "#user" ).click(function() {
        dialog.dialog( "open" );
    });
})