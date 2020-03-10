import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class Posts extends Component {
    constructor() {
        super();
        this.state = {
            posts:[],
            user: ''
        }
    }

    componentDidMount() {
        this.getPost();
        this.getUser();
        // this.timer = setInterval(()=> this.getItems(), 1000);
    }

    componentDidUpdate() {
        $.customModalInit();
    }

    componentWillUnmount() {
        // clearInterval(this.timer);
        // this.timer = null;
    }
   
    getUser() {
        axios.get('/app/user').then(response =>{
            this.setState({
                user: response.data,
            });
        }).catch(errors=> {
            console.log(errors);
        });
    }

    getPost() {
        axios.get('/app/post').then(response =>{
            this.setState({
                posts: response.data,
            });
        }).catch(errors=> {
            console.log(errors);
        });

    }

    renderImage($image){
        if ($image.length > 0) {
            return <img src={"/storage/"+$image }/>;
        }
    }

    renderEditForm($id) {
        let token = $('meta[name="csrf-token"]').attr('content');
        //console.log($('meta[name="csrf-token"]').attr('content'));
        return <form action={"/post/"+this.state.user+"/edit"} method="post"><input type="hidden" name="_token" value={token} /><input type="hidden" name="post_id" value={$id}/><button className="btn float-right" ><i className="fa fa-edit"></i></button></form>;
    }

    renderDeleteForm($id) {
        let token = $('meta[name="csrf-token"]').attr('content');
        return <form className={this.state.user+"-"+$id} action={"/post/"+this.state.user+"/delete"} method="post"><input type="hidden" name="_token" value={token} /><input type="hidden" name="_method" value="delete"/><input type="hidden" name="post_id" value={$id}/><button type="button" className="btn verify-action float-right" action="delete post"><i className="fa fa-trash"></i></button></form>;
    }

    renderPostList() {
        return (   
            <React.Fragment>
            {this.state.posts.map(post => 
                <div className="row pt-4" key={post.id}>
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">
                                {this.state.user === post.user_id ? this.renderDeleteForm(post.id) : ''}
                                {this.state.user === post.user_id ? this.renderEditForm(post.id) : ''}
                            </div>
                            <div className="card-body">
                                <div className="row post-content">
                                    {post.image.length > 0 &&
                                    <div className="col-sm-12 col-md-8">
                                        <div className="w-100 text-center">
                                        {this.renderImage(post.image)}
                                        </div>
                                    </div>
                                    }
                                    <div className={post.image.length > 0 ? 'col-sm-12 col-md-4':'col-md-12 text-center'}>
                                        <h2>{post.title}</h2>
                                        <blockquote>
                                        {post.description}
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}
            </React.Fragment>
        );

        
    }

    renderPlaceholder() {
        return (
            <React.Fragment>
                <div className="row pt-4">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">                                
                            </div>
                            <div className="card-body text-center">
                                <h2><i style={{fontSize: "4em"}} className="fa fa-exclamation-triangle"></i></h2>
                                <blockquote className="text-center">
                                No post available at the moment, be the first one!<br/>
                                <a href={'post/'+this.state.user+'/create'} className="btn btn-primary">Create!</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </React.Fragment>
        );
    }

    render() {
        if (this.state.posts.length > 0) {
            return this.renderPostList();
        } else {
            return this.renderPlaceholder();
        }
    }
}

if (document.getElementById('posts')) {
    ReactDOM.render(<Posts />, document.getElementById('posts'));
}
