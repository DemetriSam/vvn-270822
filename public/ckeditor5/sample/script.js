const watchdog = new CKSource.EditorWatchdog();

window.watchdog = watchdog;

watchdog.setCreator((element, config) => {
	return CKSource.Editor
		.create(element, config)
		.then(editor => {
			return editor;
		});
});

watchdog.setDestructor(editor => {
	return editor.destroy();
});

watchdog.on('error', handleSampleError);

function handleSampleError(error) {
	const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

	const message = [
		'Oops, something went wrong!',
		`Please, report the following error on ${issueUrl} with the build id "yg6x712t7z8h-csd452cwsnv" and the error stack trace:`
	].join('\n');

	console.error(message);
	console.error(error);
}
