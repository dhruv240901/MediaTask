$('#editProfile').validate({
  rules: {
    name: {
      required: true
    },
    phone: {
      maxlength: 10,
      minlength: 10,
      number: true
    },
  },
  messages: {
    name: 'Please enter your name',
    phone: {
      maxlength: 'Please enter valid phone number',
      minlength: 'Please enter valid phone number',
      number: 'Please enter valid phone number'
    },
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#addvideoform').validate({
  rules: {
    name: {
      required: true
    },
    video: {
      required: true,
      accept: 'video/*',
      filesize: 10 * 1024 * 1024 // 10 MB
    },
  },
  messages: {
    name: {
    required:'Please enter your name',
    },
    video: {
      required: 'Please upload video',
      accept: 'Only video accepted',
      filesize: "Please upload video less than 10MB" // 10 MB
    },
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#editvideoform').validate({
  rules: {
    name: {
      required: true
    },
  },
  messages: {
    name: {
      required:'Please enter your name',
    },
  },
  submitHandler: function (form) {
    form.submit();
  }
});


