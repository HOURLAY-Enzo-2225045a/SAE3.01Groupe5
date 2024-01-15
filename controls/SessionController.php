<?php

namespace Controls;

use Exception\MoreThanOneException;
use Exception\NotFoundException;
use View\View;

class SessionController
{
    /**
     * @var mixed
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new \Repository\SessionRepository();
    }

    public function addSessionPlayer($pseudo){
        $this->repository->addSessionPlayer($pseudo, $_SESSION['code']);
        $_SESSION['pseudo'] = $pseudo;
    }

    public function showRanking(): void
    {
        $data = $this->repository->getRanking();
        $i = 1;
        foreach ($data as $sessionUser){ echo '
            <tr class="bg-white">
                <td class="px-4 py-2 border-t border-b text-center font-bold">'. $i .'</td>
                <td class="px-4 py-2 border-t border-b text-center">' . $sessionUser->getPseudo() .'</td>
                <td class="px-4 py-2 border-t border-b text-center">' . $sessionUser->getScore().'</td>
                <td class="p-2 border bg-[var(--color-bg)] text-center">
                    <button id="callActionButton" data-id="'. $sessionUser->getSession_user_id() .'" data-modal-target="deleteModalUser" data-modal-toggle="deleteModalUser" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded" type="button">
                        <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                    </button>
                </td>
            </tr>';
            $i++;
        }
    }

    public function deleteUser($id): void
    {
        try{
            $this->repository->deleteUserById($id);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('log/HockeyGame.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }


}