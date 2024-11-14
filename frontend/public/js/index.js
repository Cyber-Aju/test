document.getElementById("check");

// Function to fetch file content and display it in the corresponding tab using diff2html
function fetchFileContent(fileName) {
  // Construct the URL with branchLeft, branchRight, and fileName as query parameters
  //   const url = `http://localhost/Git-check/server/file.php?file=${encodeURIComponent(
  //     fileName
  //   )}&branchLeft=${encodeURIComponent(
  //     branchLeft
  //   )}&branchRight=${encodeURIComponent(branchRight)}`;

  const postData = {
    file: fileName,
    branchLeft: branchLeft,
    branchRight: branchRight,
  };

  // Fetch the diff data from the server
  fetch("http://localhost/Git-check/file.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Action: "particularFile", // Custom header
    },
    body: JSON.stringify(postData), // Send parameters as JSON in the request body
  })
    .then((response) => response.json())
    .then((diffData) => {
      // Use the raw diff from the response
      const diffString = diffData.diff;

      // Define the target element for Diff2HtmlUI
      const targetElement = document.getElementById(`fileContent-${fileName}`);

      // Check if targetElement exists
      if (!targetElement) return;

      // Configuration for Diff2HtmlUI
      const configuration = {
        drawFileList: true,
        fileListToggle: false,
        fileListStartVisible: false,
        fileContentToggle: false,
        matching: "lines",
        outputFormat: "side-by-side", // Options: 'line-by-line' or 'side-by-side'
        synchronisedScroll: true,
        highlight: true,
        renderNothingWhenEmpty: false,
      };

      // Initialize and render with Diff2HtmlUI
      const diff2htmlUi = new Diff2HtmlUI(
        targetElement,
        diffString,
        configuration
      );
      diff2htmlUi.draw();
      diff2htmlUi.highlightCode(); // Optional, to highlight the code syntax

      // Make sure the tab content div is visible
      const tabPane = document.getElementById(`tab-${fileName}`);
      if (tabPane) {
        tabPane.classList.add("show", "active");
      }
    })
    .catch((error) => console.error("Error fetching diff:", error));
}

if (
  diffData.status === "success Differences" &&
  diffData.changeType === "differences"
) {
  // alert("am diff");
  // const diff2htmlUi = new Diff2HtmlUI(targetElement, diffData.diff, {
  //   drawFileList: true,
  //   fileListToggle: false,
  //   fileListStartVisible: false,
  //   fileContentToggle: false,
  //   matching: "lines",
  //   outputFormat: "side-by-side",
  //   synchronisedScroll: true,
  //   highlight: true,
  //   renderNothingWhenEmpty: false,
  // });
  // diff2htmlUi.draw();
  // diff2htmlUi.highlightCode();
}
