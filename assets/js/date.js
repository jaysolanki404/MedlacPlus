function formatDate(date) {
  const year = date.getFullYear();
  const month = (date.getMonth() + 1).toString().padStart(2, "0");
  const day = date.getDate().toString().padStart(2, "0");
  return `${year}-${month}-${day}`;
}

// Get the current date
const today = new Date();

// Calculate the maximum allowed date (one month from today)
const maxDate = new Date(today);
maxDate.setMonth(today.getMonth() + 1);

// Set the minimum and maximum date for the date picker
document.getElementById("datePicker").min = formatDate(today);
document.getElementById("datePicker").max = formatDate(maxDate);
