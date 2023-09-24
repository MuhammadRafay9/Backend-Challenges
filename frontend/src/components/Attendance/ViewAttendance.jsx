import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';

function ViewAttendance() {
  const [attendanceData, setAttendanceData] = useState([]);

  useEffect(() => {
    // Make an Axios GET request to fetch the data from your API
    axios
      .get('http://127.0.0.1:8000/api/viewAttendance')
      .then((response) => {
        // Set the fetched data in the state
        setAttendanceData(response.data.data);
      })
      .catch((error) => {
        console.error('Error fetching data:', error);
      });
  }, []); // The empty array [] ensures this effect runs only once, similar to componentDidMount

  return (
    <TableContainer component={Paper}>
      <Table sx={{ minWidth: 650 }} aria-label="simple table">
        <TableHead>
          <TableRow>
            <TableCell>Name</TableCell>
            <TableCell>Date</TableCell>
            <TableCell align="right">Clock In</TableCell>
            <TableCell align="right">Clock Out</TableCell>
            <TableCell align="right">Total Working Hours</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
        {attendanceData.map((row, index) => (
          <TableRow
            key={index} // Use the index as the key
            sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
          >
            <TableCell component="th" scope="row">
              {row.name}
            </TableCell>
            <TableCell>{row.date}</TableCell>
            <TableCell align="right">{row.clockin_formatted}</TableCell>
            <TableCell align="right">{row.clockout_formatted}</TableCell>
            <TableCell align="right">{row.total_working_hours}</TableCell>
          </TableRow>
        ))}

        </TableBody>
      </Table>
    </TableContainer>
  );
}

export default ViewAttendance;
