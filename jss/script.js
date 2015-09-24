// autocomplet : this function will be executed every time we change the text

// A $( document ).ready() block.
$( document ).ready(function() {
	
	var min_length = 0; // min caracters to display the autocomplete
					
	var keyword = $('#firm-name').val();
	
	$.ajax({
			url: 'ajax_refresh.php',
			type: 'POST',
			dataType: "json",
			data: {keyword:keyword},
			success:function(data){
			 
			
				//$('#country_list_id').show();
				//$('#country_list_id').html(data);
				//$('#tmp').val(data['ID']);
				//alert(data);
				 firms = [];
                 
				 /*
				var firms = {
                    name: 'vishant',
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                };
				cart.push(firms);
				var firms = {
                    name: 'jarmit',
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                };
			   */
				
				//alert(firms);
				jQuery.each(data, function(index, item) {
				
				//alert(item.name);
				//alert(item.post_title);
				var firmss = {
					cuid: item.customerid,
                    name: item.fname,
                    client:item.cname,
                    email:item.email,
                    phone: item.pnumber
                };
				
				firms.push(firmss);
            //now you can access properties using dot notation
        });

  	/*
                var firms = [{
                    name: data[0].post_title,
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Rasansky Law Firm',
                    client: 'Brandon Rasansky',
                    email: 'info@rlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Handler Law Firm',
                    client: 'Chelsea Handler',
                    email: 'info@handlerlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Leichter Law Firm PC',
                    client: 'Leighton Meester',
                    email: 'info@leichterlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'ABC Law Firm',
                    client: 'Andy Anderson',
                    email: 'info@abclaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Test Law Firm',
                    client: 'John Doe',
                    email: 'info@testlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'One More Law Firm',
                    client: 'Juan More',
                    email: 'info@onemorelaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Lockhart, Gardner LLC',
                    client: 'Will Gardner',
                    email: 'info@lockhartgardner.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Florrick Agos Law',
                    client: 'Alicia Florrick',
                    email: 'info@florrickagos.com',
                    phone: '214-444-1234'
                }];
				
				
*/

                var firmId = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.cuid);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
				
				var firmNames = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
				
				 var clientNames = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.client);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
                var firmEmails = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.email);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
                var firmPhones = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.email);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });

                

                // Initialise Bloodhound suggestion engines for each input
                firmId.initialize();
				firmNames.initialize();
				clientNames.initialize();
                firmEmails.initialize();
                firmPhones.initialize();
                

                // Make the code less verbose by creating variables for the following
                var firmIdTypeahead   = $('#firm-id');
				var firmNameTypeahead   = $('#firm-name');
				var clientNameTypeahead = $('#firm-client-name');
                var firmEmailTypeahead  = $('#firm-email');
                var firmPhoneTypeahead  = $('#firm-phone');
               

                firmNameTypeahead.typeahead({
                  hint: true,
                  highlight: true,
                  minLength: 1
                },
                {
                  name: 'firms',
                  displayKey: 'name',
                  source: firmNames.ttAdapter()
                }
				);

                // Set-up event handlers so that the ID is auto-populated in the id typeahead input when the name is
                var firmNameItemSelectedHandler = function (eventObject, suggestionObject, suggestionDataset) {
                    firmIdTypeahead.val(suggestionObject.cuid);
					firmEmailTypeahead.val(suggestionObject.email);
                    clientNameTypeahead.val(suggestionObject.client);
                    firmPhoneTypeahead.val(suggestionObject.phone);
                };

                  // Associate the typeahead:selected event with the bespoke handler
                firmNameTypeahead.on('typeahead:selected', firmNameItemSelectedHandler);
       
			
			}
		});
		
		//server stare here 
		
			$.ajax({
			url: 'ajax_refreshh.php',
			type: 'POST',
			dataType: "json",
			data: {keyword:keyword},
			success:function(data){
			 
			
				//$('#country_list_id').show();
				//$('#country_list_id').html(data);
				//$('#tmp').val(data['ID']);
				//alert(data);
				 firms = [];
                 
				 /*
				var firms = {
                    name: 'vishant',
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                };
				cart.push(firms);
				var firms = {
                    name: 'jarmit',
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                };
			   */
				
				//alert(firms);
				jQuery.each(data, function(index, item) {
				
				//alert(item.sname);
				//alert(item.post_title);
				var firmss = {
					sid: item.serverid,
                    name: item.sname,
                    client:item.cname,
                    email:item.email,
                    phone: item.pnumber
                };
				
				firms.push(firmss);
            //now you can access properties using dot notation
        });

  	/*
                var firms = [{
                    name: data[0].post_title,
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Rasansky Law Firm',
                    client: 'Brandon Rasansky',
                    email: 'info@rlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Handler Law Firm',
                    client: 'Chelsea Handler',
                    email: 'info@handlerlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Leichter Law Firm PC',
                    client: 'Leighton Meester',
                    email: 'info@leichterlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'ABC Law Firm',
                    client: 'Andy Anderson',
                    email: 'info@abclaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Test Law Firm',
                    client: 'John Doe',
                    email: 'info@testlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'One More Law Firm',
                    client: 'Juan More',
                    email: 'info@onemorelaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Lockhart, Gardner LLC',
                    client: 'Will Gardner',
                    email: 'info@lockhartgardner.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Florrick Agos Law',
                    client: 'Alicia Florrick',
                    email: 'info@florrickagos.com',
                    phone: '214-444-1234'
                }];
*/

                  var firmId = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.sid);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
				
				
                var firmNames = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
				
				 var clientNames = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.client);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
                var firmEmails = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.email);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
                var firmPhones = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.phone);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });

                

                // Initialise Bloodhound suggestion engines for each input
				firmId.initialize();
                firmNames.initialize();
				clientNames.initialize();
                firmEmails.initialize();
                firmPhones.initialize();
                

                // Make the code less verbose by creating variables for the following
				var firmIdTypeahead   = $('#server-id');
                var firmNameTypeahead   = $('#serverName');
				var clientNameTypeahead = $('#company-name');
                var firmEmailTypeahead  = $('#server-email');
                var firmPhoneTypeahead  = $('#server-phone');
               

                firmNameTypeahead.typeahead({
                  hint: true,
                  highlight: true,
                  minLength: 1
                },
                {
                  name: 'firms',
                  displayKey: 'name',
                  source: firmNames.ttAdapter()
                }
				);

                // Set-up event handlers so that the ID is auto-populated in the id typeahead input when the name is
                var firmNameItemSelectedHandler = function (eventObject, suggestionObject, suggestionDataset) {
                    firmIdTypeahead.val(suggestionObject.sid);
					firmEmailTypeahead.val(suggestionObject.email);
                    clientNameTypeahead.val(suggestionObject.client);
                    firmPhoneTypeahead.val(suggestionObject.phone);
                };

                  // Associate the typeahead:selected event with the bespoke handler
                firmNameTypeahead.on('typeahead:selected', firmNameItemSelectedHandler);
       
			
			}
		});
    
});

function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
					
	var keyword = $('#firm-name').val();
	if (keyword.length >= min_length) {
		//alert("data");
		$.ajax({
			url: 'ajax_refresh.php',
			type: 'POST',
			dataType: "json",
			data: {keyword:keyword},
			success:function(data){
			 
			
				//$('#country_list_id').show();
				//$('#country_list_id').html(data);
				//$('#tmp').val(data['ID']);
				//alert(data);
				 firms = [];
				
				//alert(firms);
				jQuery.each(data, function(index, item) {
				
				//alert(item.name);
				//alert(item.post_title);
				var firmss = {
                    name: item.fname,
                    client:item.cname,
                    email:item.email,
                    phone: item.pnumber
                };
				
				firms.push(firmss);
            //now you can access properties using dot notation
        });

  	/*
                var firms = [{
                    name: data[0].post_title,
                    client: 'Bob Broden',
                    email: 'info@bmlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Rasansky Law Firm',
                    client: 'Brandon Rasansky',
                    email: 'info@rlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Handler Law Firm',
                    client: 'Chelsea Handler',
                    email: 'info@handlerlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Leichter Law Firm PC',
                    client: 'Leighton Meester',
                    email: 'info@leichterlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'ABC Law Firm',
                    client: 'Andy Anderson',
                    email: 'info@abclaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Test Law Firm',
                    client: 'John Doe',
                    email: 'info@testlaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'One More Law Firm',
                    client: 'Juan More',
                    email: 'info@onemorelaw.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Lockhart, Gardner LLC',
                    client: 'Will Gardner',
                    email: 'info@lockhartgardner.com',
                    phone: '214-444-1234'
                }, {
                    name: 'Florrick Agos Law',
                    client: 'Alicia Florrick',
                    email: 'info@florrickagos.com',
                    phone: '214-444-1234'
                }];
*/
                var firmNames = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
				
				 var clientNames = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.client);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
                var firmEmails = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.email);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });
                var firmPhones = new Bloodhound({
                    datumTokenizer: function (d) {
                        return Bloodhound.tokenizers.whitespace(d.email);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: firms
                });

                

                // Initialise Bloodhound suggestion engines for each input
                firmNames.initialize();
				clientNames.initialize();
                firmEmails.initialize();
                firmPhones.initialize();
                

                // Make the code less verbose by creating variables for the following
                var firmNameTypeahead   = $('#firm-name');
				var clientNameTypeahead = $('#firm-client-name');
                var firmEmailTypeahead  = $('#firm-email');
                var firmPhoneTypeahead  = $('#firm-phone');
               

                firmNameTypeahead.typeahead({
                  hint: true,
                  highlight: true,
                  minLength: 1
                },
                {
                  name: 'firms',
                  displayKey: 'name',
                  source: firmNames.ttAdapter()
                }
				);

                // Set-up event handlers so that the ID is auto-populated in the id typeahead input when the name is
                var firmNameItemSelectedHandler = function (eventObject, suggestionObject, suggestionDataset) {
                    firmEmailTypeahead.val(suggestionObject.email);
                    clientNameTypeahead.val(suggestionObject.client);
                    firmPhoneTypeahead.val(suggestionObject.phone);
                };

                  // Associate the typeahead:selected event with the bespoke handler
                firmNameTypeahead.on('typeahead:selected', firmNameItemSelectedHandler);
       
			
			}
		});
	} else {
		//$('#country_list_id').hide();
		
	}
}

// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	//$('#country_id').val(item);
	// hide proposition list
	//$('#country_list_id').hide();
	//alert(item);
}