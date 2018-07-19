// Original version of core.js

const formObject = {
	urlDelete : 'mod/delete.php',
	
	run() {
		formObject.deleteTrigger($('.delConfirm'));
		formObject.delete($('.delete'));
		formObject.cancel($('.cancel'));
	},
	
	deleteTrigger(obj) {
		obj.on('click', function() {
			$(this).parent().prev('.confirm').fadeIn(250);
			$(this).hide();
			return false;
		});
	},
	
	delete(obj) {
		obj.on('click', function() {
			let thisParent = $(this).parent('.confirm').parent('.comment');
			let thisId = $(this).attr('data-id');
			$.post(formObject.urlDelete, {id:thisId}, function(data) {
				if (!data.error) {
					thisParent.fadeOut(250, function() {
						if (data.posts > 0) {
							$(this).remove();
						} else {
							$(this).replaceWith($('<p>There are currently no comments.</p>').hide().fadeIn(200));
						}
					});
				}
			}, 'json');
			return false;
		});
	},
	
	cancel(obj) {
		obj.on('click', function() {
			$(this).parent('.confirm').fadeOut(250);
			$(this).parent('.confirm').siblings('.commentContent').children('.delConfirm').fadeIn(2000);
			return false;
		});
	}
};

$(() => {
	formObject.run();
});
