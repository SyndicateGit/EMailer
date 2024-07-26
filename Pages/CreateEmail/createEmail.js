const emailBodyConfig = {
    promotion: false,
    selector: '#email-body-editor',
};

const mainTinyMCEInit = {
    promotion: false,
    license: 'gpl',
};

tinymce.init(mainTinyMCEInit);
tinymce.init(emailBodyConfig);

const darkmode = localStorage.getItem('darkMode');
if(darkmode == 'true'){
  document.body.classList.add('dark');
}