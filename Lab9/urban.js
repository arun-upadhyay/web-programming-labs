// CSE 154, Urban Dictionary lab (Ajax/XML) solution
"use strict";

(function() {
	var SERVICE = "http://mumstudents.org/cs472/2015-07-DE/Labs/8/urban.php";

	window.onload = function() {
		document.getElementById("lookup").onclick = doLookup;
	};

	// Searches for all definitions of the word currently in the text box.
	// Uses Ajax to fetch the data.
	function doLookup() {
		var term = document.getElementById("term").value;
		var ajax = new XMLHttpRequest();
		ajax.onload = receivedXML;
		ajax.open("GET", SERVICE + "?term=" + term + "&all=true", true);
		ajax.send();
	}

	// Called by Ajax request when the definition XML data arrives successfully.
	// Parses the XML and inserts it into the page as a sequence of paragraphs.
	function receivedXML() {
		var list = document.createElement("ol");

		var entries = this.responseXML.getElementsByTagName("entry");
		for (var i = 0; i < entries.length; i++) {
			var definitionNode = entries[i].getElementsByTagName("definition")[0];
			var definition = document.createElement("p");
			definition.innerHTML = definitionNode.firstChild.nodeValue;

			var exampleNode = entries[i].getElementsByTagName("example")[0];
			var example = document.createElement("p");
			example.className = "example";
			example.innerHTML = exampleNode.firstChild.nodeValue;

			var author = document.createElement("p");
			author.className = "author";
			author.innerHTML = entries[i].getAttribute("author");
			author.onclick = authorClick;

			var li = document.createElement("li");
			li.appendChild(definition);
			li.appendChild(example);
			li.appendChild(author);
			list.appendChild(li);
		}

		var result = document.getElementById("result");
		result.innerHTML = "";
		result.appendChild(list);
	}

	// Called when the user clicks on one of the author names.
	// Contacts the server to find out what words have been defined by that user.
	function authorClick() {
		var ajax = new XMLHttpRequest();
		ajax.onload = receivedAllWordsByAuthor;
		ajax.open("GET", SERVICE + "?author=" + this.innerHTML, true);
		ajax.send();
	}

	// Called by Ajax request when the author definition XML data arrives successfully.
	// Parses the XML data and inserts it into the page as a paragraph.
	// Example XML data received:
	// <words author="silly_walk">
	//   <word entry="ATM" defid="825904" />
	//   <word entry="moog" defid="815030" />
	//   <word entry="OMC" defid="1012620" />
	//   <word entry="OFC" defid="1012612" />
	// </words>
	function receivedAllWordsByAuthor() {
		var h2 = document.createElement("h2");
		h2.innerHTML = "All entries by " + this.responseXML.getElementsByTagName("words")[0].getAttribute("author");
		var p = document.createElement("p");
		var words = this.responseXML.getElementsByTagName("word");
		for (var i = 0; i < words.length; i++) {
			if (p.innerHTML) {
				p.innerHTML += ", ";
			}
			p.innerHTML += words[i].getAttribute("entry");
		}
		var related = document.getElementById("related");
		related.innerHTML = "";
		related.appendChild(h2);
		related.appendChild(p);
	}
})();