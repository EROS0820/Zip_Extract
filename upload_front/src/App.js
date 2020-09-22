import axios from 'axios'; 

import React,{Component} from 'react'; 

class App extends Component { 

	state = { 
    selectedFile: null
	}; 

	onFileChange = event => { 
  	this.setState({ selectedFile: event.target.files[0] }); 
	}; 
	
	onFileUpload = () => { 
    if (!this.state.selectedFile || this.state.selectedFile.type != "application/x-zip-compressed") { 
      window.alert("Please fill the zip file");
      return;
    }
    const formData = new FormData(); 
  
    formData.append( 
      "zip_file", 
      this.state.selectedFile, 
      this.state.selectedFile.name 
    ); 
    axios.post(process.env.REACT_APP_END_POINT +"/api/uploadfile", formData); 
	}; 
	
	// File content to be displayed after 
	// file upload is complete 
	fileData = () => { 
	
	if (this.state.selectedFile) { 
		
		return ( 
		<div> 
			<h2>File Details:</h2> 
			<p>File Name: {this.state.selectedFile.name}</p> 
			<p>File Type: {this.state.selectedFile.type}</p> 
			<p> 
			Last Modified:{" "} 
			{this.state.selectedFile.lastModifiedDate.toDateString()} 
			</p> 
		</div> 
		); 
	} else { 
		return ( 
		<div> 
			<br /> 
			<h4>Choose before Pressing the Upload button</h4> 
		</div> 
		); 
	} 
	}; 
	
	render() { 
	
	return ( 
		<div> 
			<h3> 
			File Upload using React! 
			</h3> 
			<div> 
				<input type="file" accept=".zip" onChange={this.onFileChange} /> 
				<button onClick={this.onFileUpload}> 
				Upload! 
				</button> 
			</div> 
		{this.fileData()} 
		</div> 
	); 
	} 
} 

export default App; 
