import 'package:flutter/cupertino.dart';
import 'package:mobileapplication/events/getroom_event.dart';
import 'package:mobileapplication/models/room_response.dart';
import 'package:mobileapplication/responsitory/repository.dart';
import 'package:mobileapplication/states/getroom_state.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class GetRoomBloc extends Bloc<GetRoomEvent, GetRoomState> {
  final Repository repository;
  GetRoomBloc(@required this.repository)
      : assert(repository != null),
        super(GetRoomStateInitial());

  @override
  Stream<GetRoomState> mapEventToState(GetRoomEvent getRoomEvent) async* {
    if (getRoomEvent is GetRoomEventRequested) {
      yield GetRoomStateLoading();
      try {
        final Room_Response? room_response =
            await repository.getques(getRoomEvent.idroom);
        if (room_response != null) {
          yield GetRoomStateSuccess(room_response);
        } else {
          yield GetRoomStateFail();
        }
      } catch (e) {
        yield GetRoomStateFail();
      }
    }
  }
}
