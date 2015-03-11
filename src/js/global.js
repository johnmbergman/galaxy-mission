/*
Scrum of the Earth
Global Javascript functions for Galaxy Mission
*/ 

// Function that takes string and returns popup output for character
// Adam Hill 3/10/15
function characterSpeak(string)
{
	return BootstrapDialogue.show({
		title: '{Character's name} says:',
		message: string
		});
}