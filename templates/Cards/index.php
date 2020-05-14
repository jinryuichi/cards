<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cards</title>
<script>
  window.console = window.console || function(t) {};
</script>
<script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
</head>
<body translate="no">
<div id="root"></div>
<script src='/js/react.development.js'></script>
<script src='/js/react-dom.development.js'></script>
<script src="/js/jquery.min.js"></script>
<script id="rendered-js">

class PlayerForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = { value: '' };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }



  handleChange(event) {
    
  /* const re = /^[0-9\b]+$/; */
      const re = /^\d*$/;
            if ((parseInt(event.target.value) <= 10 || event.target.value === '') && re.test(event.target.value)) {
		    this.setState({value: event.target.value})
	    }

  }

  handleSubmit(event) {
  $('#table').html('');

    // alert('A value was submitted: ' + this.state.value);
    fetch("/cards/cards/" + this.state.value )
      .then(res => res.json())
      .then(
        (result) => {

        // console.log(result);
        var res = "<ul>";

        $.each(result, function (index1, item1) {
            res += "<li>" + item1 + "</li>";
        });

        res += "</ul>";
        $('#table').html(res);

        //console.log(res);

        },

        (error) => {
            //
        }
      )
    event.preventDefault();
  }



  render() {

    return (
      React.createElement("form", { onSubmit: this.handleSubmit },
      React.createElement("label", null, "Players (< 10):",
      React.createElement("input", { type: "text", value: this.state.value, onChange: this.handleChange })),
      React.createElement("input", { type: "submit", value: "Submit" }))
      );

      
  }}




ReactDOM.render(
React.createElement(PlayerForm, null),
document.getElementById('root'));



    </script>

<div id="table" class="table"></div>

</body>
</html>
