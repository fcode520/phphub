<?php
//�ղ�
class FavoritesController extends \BaseController
{
    public function createOrDelete($id)
    {
        $topic = Topic::find($id);

        if (Favorite::isUserFavoritedTopic(Auth::user(), $topic)) {
            Auth::user()->favoriteTopics()->detach($topic->id);
            $topic->decrement('favorite_count', 1);
        } else {

            Auth::user()->favoriteTopics()->attach($topic->id);
            Notification::notify('topic_favorite', Auth::user(), $topic->user, $topic);
            $topic->increment('favorite_count', 1);
        }
        Flash::success(lang('Operation succeeded.'));
//        return "sucess";
        return Redirect::route('topics.show', $topic->id);
    }
}
