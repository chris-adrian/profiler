import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Posts extends Component {
    constructor(props) {
        super(props);
         

    }

    componentDidMount() {
        console.log('hello word');
    }

    render() {
        return (
            <div className="row justify-content-center pt-4">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example component!</div>
                    </div>
                </div>
            </div>

        );
    }
}

if (document.getElementById('posts')) {
    ReactDOM.render(<Posts />, document.getElementById('posts'));
}
