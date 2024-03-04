import { Rectangle } from "./Rectangle.js"

export class Goal {
    constructor(back, leftPost, rightPost) {
        this.back = back;
        this.leftPost = leftPost;
        this.rightPost = rightPost;

        this.inside = new Rectangle(
            this.back.x+this.back.height,
            this.leftPost.y,
            this.back.width-this.back.height*2 ,
            Math.trunc(this.back.width/2),
            "red"
        );

        this.answer = null;
    }

    draw(context) {
        this.inside.draw(context);
        this.leftPost.draw(context);
        this.rightPost.draw(context);
        this.back.draw(context);
    }

    getBack(){
        return this.back;
    }
}

