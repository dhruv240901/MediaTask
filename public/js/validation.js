$('#editProfile').validate({
  rules: {
    name: {
      required: true
    },
    phone: {
      maxlength: 10,
      minlength: 10,
      number: true
    }
  },
  messages: {
    name: 'Please enter your name',
    phone: {
      maxlength: 'Please enter phone number less than 10 digit',
      minlength: 'Please enter phone number more than 10 digit',
      number: 'Please enter valid phone number'
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$.validator.addMethod(
  'filesize',
  function (value, element, param) {
    // Check if the file input is empty
    if (element.files.length === 0) {
      return true; // Skip validation if no file is selected
    }
    
    // Get the file size in bytes
    var fileSize = element.files[0].size;
    return fileSize <= param;
  },
  'Video Size must be less than or equal to 30MB'
);

$('#addvideoform').validate({
  rules: {
    name: {
      required: true
    },
    video: {
      required: true,
      accept: 'video/*',
      filesize: 30 * 1024 * 1024 // 30 MB
    }
  },
  messages: {
    name: {
      required: 'Please enter your name'
    },
    video: {
      required: 'Please upload video',
      accept: 'Only video accepted'
    }
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
    video: {
      accept: 'video/*',
      filesize: 30 * 1024 * 1024 // 30 MB
    }
  },
  messages: {
    name: {
      required: 'Please enter your name'
    },
    video: {
      accept: 'Only video accepted'
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});
