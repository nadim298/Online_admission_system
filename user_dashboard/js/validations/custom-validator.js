$(document).ready(function() {
	$('#defaultForm').bootstrapValidator();
	$('#signupForm').bootstrapValidator();

	// Invisible Fields
	$('button[data-toggle]').on('click', function() {
		var $target = $($(this).attr('data-toggle'));
		$target.toggle();
		if (!$target.is(':visible')) {
		// Enable the submit buttons in case additional fields are not valid
			$('#invisibleFields').data('bootstrapValidator').disableSubmitButtons(false);
		}
	});
	$('#invisibleFields').bootstrapValidator();

	// Percentage
	$('#percentageForm').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'percentage': {
				selector: '.percent',
				validators: {
					notEmpty: {
						message: 'The percentage is required'
					},
					callback: {
						message: 'The sum must be 100',
						callback: function(value, validator) {
							var percentage = validator.getFieldElements('percentage'),
								length = percentage.length,
								sum = 0;
							for (var i = 0; i < length; i++) {
								sum += parseFloat($(percentage[i]).val());
							}
							if (sum == 100) {
								validator.updateStatus('percentage', 'VALID', 'callback');
								return true;
							}
							return false;
						}
					}
				}
			}
		}
	});

	// Creditcard
	$('#paymentForm').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			cardHolder: {
				selector: '#cardHolder',
				validators: {
					notEmpty: {
						message: 'The card holder is required'
					},
					stringCase: {
						message: 'The card holder must contain upper case characters only',
						case: 'upper'
					}
				}
			},
			ccNumber: {
				selector: '#ccNumber',
				validators: {
					notEmpty: {
						message: 'The credit card number is required'
					},
					creditCard: {
						message: 'The credit card number is not valid'
					}
				}
			},
			expMonth: {
				selector: '[data-stripe="exp-month"]',
				validators: {
					notEmpty: {
						message: 'The expiration month is required'
					},
					digits: {
						message: 'The expiration month can contain digits only'
					},
					callback: {
						message: 'Expired',
						callback: function(value, validator) {
							value = parseInt(value, 10);
							var currentMonth = new Date().getMonth() + 1;
							return (value <= 12 && value >= currentMonth);
						}
					}
				}
			},
			expYear: {
				selector: '[data-stripe="exp-year"]',
				validators: {
					notEmpty: {
						message: 'The expiration year is required'
					},
					digits: {
						message: 'The expiration year can contain digits only'
					},
					callback: {
						message: 'Expired',
						callback: function(value, validator) {
							value = parseInt(value, 10);
							var currentYear = new Date().getFullYear();
							return (value >= currentYear && value <= currentYear + 100);
						}
					}
				}
			},
			cvvNumber: {
				selector: '.cvvNumber',
				validators: {
					notEmpty: {
						message: 'The CVV number is required'
					},
					cvv: {
						message: 'The value is not a valid CVV',
						creditCardField: 'ccNumber'
					}
				}
			}
		}
	});

	// Tabs Example
	$('#accountForm')
	.bootstrapValidator({
		excluded: [':disabled'],
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			fullName: {
				validators: {
					notEmpty: {
						message: 'The full name is required'
					}
				}
			},
			company: {
				validators: {
					notEmpty: {
						message: 'The company name is required'
					}
				}
			},
			address: {
				validators: {
					notEmpty: {
						message: 'The address is required'
					}
				}
			},
			city: {
				validators: {
					notEmpty: {
						message: 'The city is required'
					}
				}
			}
		}
	});

});