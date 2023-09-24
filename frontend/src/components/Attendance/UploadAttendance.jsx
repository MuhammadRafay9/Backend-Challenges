import React, { useState } from 'react';
import axios from 'axios';
import Button from '@mui/material/Button';
import Stack from '@mui/material/Stack';
import SendIcon from '@mui/icons-material/Send';

function UploadAttendance() {
  const containerStyle = {
    height: '50vh',
  };

  const secondDiv = {
    height: '50vh',
    display: 'flex',
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'center',
  };

  const [selectedFile, setSelectedFile] = useState(null);

  const handleFileChange = (event) => {
    const file = event.target.files[0];
    // Check if the selected file is an Excel file
    if (
      file &&
      (file.type ===
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
        file.type === 'application/vnd.ms-excel')
    ) {
      setSelectedFile(file);
    } else {
      // Show an error message or alert for invalid file type
      alert('Please select a valid Excel file (.xlsx or .xls)');
    }
  };

  const handleUpload = async () => {
    if (selectedFile) {
      const formData = new FormData();
      formData.append('excel_file', selectedFile);

      try {
        // Log the selectedFile state before making the request
        console.log('Selected File:', selectedFile);

        // Make a POST request to your server to handle the file upload
        const response = await axios.post(
          'http://127.0.0.1:8000/api/uploadAttendance',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          }
        );

        // Handle the response from the server as needed
        console.log('File upload successful:', response.data);
      } catch (error) {
        // Handle any errors that occurred during the upload
        console.error('File upload error:', error);
      }
    } else {
      // Show an error message or alert for no selected file
      alert('Please select a file to upload.');
    }
  };

  return (
    <div style={containerStyle} className="abc">
      <div style={secondDiv}>
        <Stack direction="row" alignItems="center" spacing={2}>
          <Button variant="contained" component="label">
            Select Excel File
            <input
              hidden
              accept=".xlsx, .xls"
              type="file"
              onChange={handleFileChange}
            />
          </Button>
          <Button
            variant="contained"
            endIcon={<SendIcon />}
            onClick={handleUpload}
          >
            Upload
          </Button>
        </Stack>
      </div>
    </div>
  );
}

export default UploadAttendance;
