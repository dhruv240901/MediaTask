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
